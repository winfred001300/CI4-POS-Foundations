<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\SaleItemModel;

class Sales extends BaseController
{
    protected $productModel;
    protected $saleModel;
    protected $saleItemModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->saleModel = new SaleModel();
        $this->saleItemModel = new SaleItemModel();
    }

    // Display the Record Sale form.
    public function index()
    {
        $data['products'] = $this->productModel
            ->where('stock_quantity >', 0)
            ->orderBy('product_name', 'ASC')
            ->findAll();

        return view('sales_new', $data);
    }

    // Record a sale and deduct the stock.
    public function create()
    {
        $rules = [
            'product_id' => 'required|integer',
            'quantity'   => 'required|integer|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $productId = (int) $this->request->getPost('product_id');
        $quantity  = (int) $this->request->getPost('quantity');

        $db = \Config\Database::connect();

        $db->transBegin();

        try {
            // Lock the selected product row while processing this sale.
            $product = $db->query(
                'SELECT * FROM products WHERE id = ? FOR UPDATE',
                [$productId]
            )->getRowArray();

            if (!$product) {
                $db->transRollback();

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'The selected product was not found.');
            }

            if ((int) $product['stock_quantity'] < $quantity) {
                $db->transRollback();

                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Not enough stock for this quantity.');
            }

            $unitPrice = (float) $product['price'];
            $subtotal = round($unitPrice * $quantity, 2);

            $userId = session()->get('userId');

            $saleData = [
                'user_id' => $userId ?: null,
                'total_amount' => $subtotal,
                'sale_date' => date('Y-m-d H:i:s')
            ];

            if (!$db->table('sales')->insert($saleData)) {
                throw new \RuntimeException('Could not save the sale.');
            }

            $saleId = $db->insertID();

            if (!$db->table('sale_items')->insert([
                'sale_id' => $saleId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal
            ])) {
                throw new \RuntimeException('Could not save the sale item.');
            }

            // Deduct stock only if enough stock remains.
            $db->table('products')
                ->set('stock_quantity', 'stock_quantity - ' . $quantity, false)
                ->where('id', $productId)
                ->where('stock_quantity >=', $quantity)
                ->update();

            if ($db->affectedRows() !== 1) {
                throw new \RuntimeException('Could not update product stock.');
            }

            if ($db->transStatus() === false) {
                throw new \RuntimeException('The database transaction failed.');
            }

            $db->transCommit();

            return redirect()->to(site_url('sales/history'))
                ->with('success', 'Sale recorded successfully.');

        } catch (\Throwable $e) {
            $db->transRollback();

            log_message('error', 'Sale recording failed: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'The sale could not be recorded. Please check the product and stock, then try again.');
        }
    }

    // Display previous sales.
    public function history()
    {
        $sales = $this->saleModel
            ->orderBy('id', 'DESC')
            ->findAll();

        $itemsBySale = [];

        foreach ($sales as $sale) {
            $itemsBySale[$sale['id']] = $this->saleItemModel
                ->where('sale_id', $sale['id'])
                ->findAll();
        }

        return view('sales_history', [
            'sales' => $sales,
            'itemsBySale' => $itemsBySale
        ]);
    }
}
