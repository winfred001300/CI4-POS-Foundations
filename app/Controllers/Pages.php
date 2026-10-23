<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function landing()
    {
        return view('landing');
    }

    public function about()
    {
        return view('about');
    }

    public function profile()
    {
        // Check whether the user is logged in.
        if (! session()->get('isLoggedIn')) {
            return redirect()->to(site_url('login'))
                ->with('error', 'Please log in to view your profile.');
        }

        return view('profile');
    }
}