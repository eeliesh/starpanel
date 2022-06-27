<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class PlayersController extends Controller
{
    public function index()
    {
        return view('owner.players.index')->with([
            'players' => User::paginate(25)
        ]);
    }
}
