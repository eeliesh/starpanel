<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Admin;
use App\Models\Rank;
use App\Models\User;

class OwnerAdminsController extends Controller
{
    public function index()
    {
        $admins = Admin::all();

        foreach ($admins as $admin) {
            $admin['rank'] = Rank::where('access_flags', $admin->access)->first()['name'];
        }

        return view('owner.admins.index')->with([
            'admins' => $admins
        ]);
    }

    public function add()
    {
        return view('owner.admins.add')->with([
            'ranks' => Rank::all(),
            'allowedFlags' => ['a', 'ce', 'de'],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'auth' => 'required|exists:users,name|unique:admins',
            'password' => 'required',
            'access' => 'required',
            'flags' => ['required', Rule::in(['a', 'ce', 'de'])]
        ]);

        Admin::create([
            'auth' => $request->input('auth'),
            'password' => $request->input('password'),
            'access' => $request->input('access'),
            'flags' => $request->input('flags'),
            'user_id' => User::select('id')->where('name', $request->input('auth'))->first()['id']
        ]);

        return redirect(route('owner.admins.all'))->with([
            'message' => 'Admin successfully added.',
            'message-type' => 'success',
        ]);
    }

    public function edit($id)
    {
        $admin = Admin::where('id', $id)->firstOrFail();

        if (!$admin)
            abort(404);
        
        return view('owner.admins.edit')->with([
            'admin' => $admin,
            'ranks' => Rank::all(),
            'allowedFlags' => ['a', 'ce', 'de'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'auth' => 'required|exists:users,name',
            'password' => 'required',
            'access' => 'required',
            'flags' => ['required', Rule::in(['a', 'ce', 'de'])]
        ]);

        Admin::where('id', $id)->update([
            'auth' => $request->input('auth'),
            'password' => $request->input('password'),
            'access' => $request->input('access'),
            'flags' => $request->input('flags')
        ]);

        return redirect(route('owner.admins.edit', ['id' => $id]))->with([
            'message' => 'Admin successfully updated.',
            'message-type' => 'success'
        ]);
    }
}
