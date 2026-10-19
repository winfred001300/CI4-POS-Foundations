<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Customers extends BaseController
{
    public function index()
    {
        $customerModel = new CustomerModel();
        $customers = $customerModel->findAll();

        return view('customers', [
            'customers' => $customers
        ]);
    }

    public function new()
    {
        return view('customers_new');
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $customerModel = new CustomerModel();

        $customerModel->insert([
            'full_name'  => trim($this->request->getPost('full_name')),
            'email'      => trim($this->request->getPost('email')),
            'phone'      => trim($this->request->getPost('phone') ?? ''),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer added successfully.');
    }

    public function edit($id)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if (!$customer) {
            throw PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        return view('customers_edit', [
            'customer' => $customer
        ]);
    }

    public function update($id)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if (!$customer) {
            throw PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $customerModel->update($id, [
            'full_name' => trim($this->request->getPost('full_name')),
            'email'     => trim($this->request->getPost('email')),
            'phone'     => trim($this->request->getPost('phone') ?? ''),
        ]);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer updated successfully.');
    }

    public function delete($id)
    {
        $customerModel = new CustomerModel();
        $customer = $customerModel->find($id);

        if (!$customer) {
            throw PageNotFoundException::forPageNotFound(
                'Customer not found.'
            );
        }

        $customerModel->delete($id);

        return redirect()->to(site_url('customers'))
            ->with('success', 'Customer deleted successfully.');
    }
}
