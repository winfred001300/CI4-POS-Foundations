<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('users', [
            'users' => $users
        ]);
    }

    public function new()
    {
        return view('users_new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|is_unique[users.username]',
            'full_name' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ]);

        return redirect()->to('/users')
            ->with('success', 'User added successfully.');
    }



public function edit($id)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);

    if (!$user) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
            'User not found.'
        );
    }

    return view('users_edit', [
        'user' => $user
    ]);
}

    public function update($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User not found.'
            );
        }

        $rules = [
            'username'  => "required|is_unique[users.username,id,{$id}]",
            'full_name' => 'required',
        ];

        $avatar = $this->request->getFile('avatar');

        if ($avatar && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $rules['avatar'] = [
                'label' => 'Avatar',
                'rules' => [
                    'uploaded[avatar]',
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpeg,image/png]',
                    'max_size[avatar,2048]',
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
        ];

        if (
            $avatar
            && $avatar->isValid()
            && !$avatar->hasMoved()
        ) {
            $newName = $avatar->getRandomName();
            $uploadDirectory = FCPATH . 'uploads/';

            if (
                !is_dir($uploadDirectory)
                && !mkdir($uploadDirectory, 0755, true)
                && !is_dir($uploadDirectory)
            ) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'The uploads folder could not be created.'
                    ]);
            }

            $destination = $uploadDirectory . $newName;

            try {
                \Config\Services::image()
                    ->withFile($avatar->getTempName())
                    ->fit(150, 150, 'center')
                    ->save($destination);
            } catch (\Throwable $e) {
                log_message(
                    'error',
                    'Avatar processing failed: ' . $e->getMessage()
                );

                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'Avatar processing error: ' . $e->getMessage()
                    ]);
            }

            if (!is_file($destination)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'avatar' => 'Image processing finished, but the thumbnail file was not created.'
                    ]);
            }

            $data['avatar'] = $newName;
        }

        $userModel->update($id, $data);

        return redirect()->to('/users')
            ->with('success', 'User updated successfully.');
    }
}