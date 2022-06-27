<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;
use App\Models\Rank;
use App\Models\User;
use App\Models\StaffLog;

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

        $user = User::select('id', 'name')->where('name', $request->input('auth'))->first();

        Admin::create([
            'auth' => $request->input('auth'),
            'password' => $request->input('password'),
            'access' => $request->input('access'),
            'flags' => $request->input('flags'),
            'user_id' => $user->id,
        ]);

        StaffLog::create([
            'performer_id' => Auth::user()->id,
            'performed_on' => $user->id,
            'message' => Auth::user()->name . ' promoted ' . $user->name . ' to admin (' . Rank::where('access_flags', $request->input('access'))->first()['name'] . ').',
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

        $user = User::select('id', 'name')->where('id', $id)->first();

        StaffLog::create([
            'performer_id' => Auth::user()->id,
            'performed_on' => $user->id,
            'message' => Auth::user()->name . " changed " . $user->name . "'s admin rank to " . Rank::where('access_flags', $request->input('access'))->first()['name'] . ".",
        ]);

        return redirect(route('owner.admins.edit', ['id' => $id]))->with([
            'message' => 'Admin successfully updated.',
            'message-type' => 'success'
        ]);
    }

    public function delete($id)
    {
        $admin = Admin::where('id', $id)->first();

        if (is_null($admin))
            abort(404);

        StaffLog::create([
            'performer_id' => Auth::user()->id,
            'performed_on' => $admin->user->id,
            'message' => Auth::user()->name . ' removed ' . $admin->user->name . ' from the administrative team.'
        ]);

        $admin->delete();

        return redirect(route('owner.admins.all'))->with([
            'message' => 'The admin was removed from staff.',
            'message-type' => 'success'
        ]);
    }
}
