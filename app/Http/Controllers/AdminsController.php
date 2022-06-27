<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;

class AdminsController extends Controller
{
    public function staff()
    {
        return view('admins.staff', [
            'admins' => Admin::orderBy('access', 'asc')->get(),
        ]);
    }
}
