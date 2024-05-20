<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function dashboard(): string{
        return view("admin/dashboard");
    }
    public function pengguna(): string{
        return view("admin/pengguna");
    }
}