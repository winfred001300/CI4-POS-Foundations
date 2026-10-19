<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Products extends BaseController
{
    protected ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // Display all products
    public function index()
    {
        $data['products'] = $this->productModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view('products', $data);
    }

    // Display the Add Product form
    public function new()
    {
        return view('products_new');
    }

    // Save a new product
    public function create()
    {
        $rules = [
            'product_name' => 'required|min_length[2]|max_length[150]',
            'description' => 'permit_empty',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('products/new'))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->productModel->insert([
            'product_name' => trim($this->request->getPost('product_name')),
            'description' => trim(
                $this->request->getPost('description') ?? ''
            ),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ]);

        return redirect()->to(site_url('products'))
            ->with('success', 'Product added successfully.');
    }

    // Display the Edit Product form
    public function edit($id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            throw PageNotFoundException::forPageNotFound(
                'Product not found.'
            );
        }

        return view('products_edit', ['product' => $product]);
    }

    // Update an existing product
    public function update($id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            throw PageNotFoundException::forPageNotFound(
                'Product not found.'
            );
        }

        $rules = [
            'product_name' => 'required|min_length[2]|max_length[150]',
            'description' => 'permit_empty',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('products/edit/' . $id))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->productModel->update($id, [
            'product_name' => trim($this->request->getPost('product_name')),
            'description' => trim(
                $this->request->getPost('description') ?? ''
            ),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
        ]);

        return redirect()->to(site_url('products'))
            ->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if (! $product) {
            throw PageNotFoundException::forPageNotFound(
                'Product not found.'
            );
        }

        try {
            $this->productModel->delete($id);
        } catch (\Throwable $e) {
            log_message('error', 'Product deletion failed: ' . $e->getMessage());

            return redirect()->to(site_url('products'))
                ->with('error', 'Unable to delete this product. It may be linked to an existing sale.');
        }

        return redirect()->to(site_url('products'))
            ->with('success', 'Product deleted successfully.');
    }
}
