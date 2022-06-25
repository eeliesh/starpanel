<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Rank;

class AdminsController extends Controller
{
    public function staff()
    {
        $ranks = Rank::all();

        // make access_flags as key index and name as value
        $ranks = $ranks->mapWithKeys(function ($item) {
            return [$item->access_flags => $item->name];
        });

        return view('admins.staff', [
            'admins' => Admin::orderBy('access', 'desc')->get(),
            'ranks' => $ranks->toArray(),
        ]);
    }
}
