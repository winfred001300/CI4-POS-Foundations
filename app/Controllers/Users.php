<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        return view('users', [
            'users' => $userModel->findAll(),
        ]);
    }

    public function new()
    {
        return view('users_new');
    }

    public function create()
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|max_length[50]|is_unique[users.username]',
            ],
            'full_name' => [
                'label' => 'Full Name',
                'rules' => 'required|max_length[100]',
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[255]',
            ],
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|max_size[avatar,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'   => trim((string) $this->request->getPost('username')),
            'full_name'  => trim((string) $this->request->getPost('full_name')),
            'password'   => password_hash(
                (string) $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $uploadDirectory = FCPATH . 'uploads/';

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            $newName = $avatar->getRandomName();

            if (!$avatar->move($uploadDirectory, $newName)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'The avatar could not be uploaded.',
                    ]);
            }

            $data['avatar'] = $newName;
        }

        $userModel = new UserModel();
        $userModel->insert($data);

        return redirect()->to(site_url('users'))
            ->with('success', 'Staff account created successfully.');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('users_edit', [
            'user' => $user,
        ]);
    }

    public function update($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            ],
            'full_name' => [
                'label' => 'Full Name',
                'rules' => 'required|max_length[100]',
            ],
            'password' => [
                'label' => 'New Password',
                'rules' => 'permit_empty|min_length[8]|max_length[255]',
            ],
            'avatar' => [
                'label' => 'Avatar',
                'rules' => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpeg,image/png]|max_size[avatar,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];

        $newPassword = (string) $this->request->getPost('password');

        if ($newPassword !== '') {
            $data['password'] = password_hash(
                $newPassword,
                PASSWORD_DEFAULT
            );
        }

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $uploadDirectory = FCPATH . 'uploads/';

            if (!is_dir($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            $newName = $avatar->getRandomName();

            if (!$avatar->move($uploadDirectory, $newName)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'The avatar could not be uploaded.',
                    ]);
            }

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to(site_url('users'))
            ->with('success', 'Staff account updated successfully.');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        // Prevent deleting the currently logged-in account.
        if ((int) session()->get('userId') === (int) $id) {
            return redirect()->to(site_url('users'))
                ->with('errors', [
                    'You cannot delete your own logged-in account.',
                ]);
        }

        $userModel->delete($id);

        return redirect()->to(site_url('users'))
            ->with('success', 'Staff account deleted successfully.');
    }
}
