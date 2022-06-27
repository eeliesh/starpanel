<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Admin;
use App\Models\Rank;

class UsersController extends Controller
{
    public function players()
    {
        return view('users.players', [
            'players' => User::paginate(25),
        ]);
    }

    public function profile($id)
    {
        $player = User::findOrFail($id);

        if (!$player)
            abort(404);

        $admin = Admin::where('user_id', $player->id)->first();
        $admin_rank = 'Unknown';
        if (!empty($admin)) {
            $admin_rank = Rank::where('access_flags', $admin->access)->first()['name'];
        }

        return view('users.profile')->with([
            'player' => $player,
            'admin' => Admin::where('user_id', $player->id)->first(),
            'admin_rank' => $admin_rank,
        ]);
    }

    public function settings()
    {
        $activePage = 'overview';
        $allowedPages = ['overview', 'username', 'email', 'password', 'admin'];

        foreach ($allowedPages as $page) {
            if (request()->is('settings/' . $page)) {
                $activePage = $page;
                break;
            }
        }

        return view('users.settings')->with([
            'user' => User::where('id', Auth::user()->id)->first(),
            'active_page' => $activePage,
        ]);
    }

    public function submitRequest(Request $request)
    {
        $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();
        $invalidPassword = 'The password you entered does not match the one from your account.';

        // username change
        if ($request->has('change_username')) {
            $validator = Validator::make($request->all(), [
                'new_name' => ['required', 'string', 'max:255', 'unique:users,name'],
                'confirm_password' => ['required']
            ]);

            $validator->after(function ($validator) use ($user, $invalidPassword) {
                if (!Hash::check($validator->getData()['confirm_password'], $user->password)) {
                    $validator->errors()->add('confirm_password', $invalidPassword);
                }
            });

            $validator->validate();

            User::where('id', $user->id)->update([
                'name' => $request->input('new_name'),
            ]);

            return redirect()->back()->with([
                'message' => 'Your username has been successfully changed.',
                'message-type' => 'success'
            ]);
        }

        // email change
        if ($request->has('change_email')) {
            $validator = Validator::make($request->all(), [
                'new_email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'confirm_password' => ['required']
            ]);

            $validator->after(function ($validator) use ($user, $invalidPassword) {
                if (!Hash::check($validator->getData()['confirm_password'], $user->password)) {
                    $validator->errors()->add('confirm_password', $invalidPassword);
                }
            });

            $validator->validate();

            User::where('id', $user->id)->update([
                'email' => $request->input('new_email'),
            ]);

            return redirect()->back()->with([
                'message' => 'Your email has been successfully changed.',
                'message-type' => 'success'
            ]);
        }

        // password change
        if ($request->has('change_password')) {
            $validator = Validator::make($request->all(), [
                'current_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            $validator->after(function ($validator) use ($user, $invalidPassword) {
                if (!Hash::check($validator->getData()['current_password'], $user->password)) {
                    $validator->errors()->add('current_password', $invalidPassword);
                }
            });

            $validator->validate();

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->input('new_password'))
            ]);

            return redirect()->back()->with([
                'message' => 'Your password has been successfully changed.',
                'message-type' => 'success'
            ]);
        }

        // admin password change
        if ($request->has('change_admin_password')) {
            $validator = Validator::make($request->all(), [
                'account_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8', 'confirmed']
            ]);

            $validator->after(function ($validator) use ($user, $invalidPassword) {
                if (!Hash::check($validator->getData()['account_password'], $user->password)) {
                    $validator->errors()->add('account_password', $invalidPassword);
                }
            });

            $validator->validate();

            Admin::where('user_id', Auth::user()->id)->update([
                'password' => $request->input('new_password')
            ]);

            return redirect()->back()->with([
                'message' => 'Your admin password has been successfully changed.',
                'message-type' => 'success'
            ]);
        }
    }

    public function search(Request $request)
    {
        if (!$request->input('query') || !$request->input('_token'))
            abort(404);

        return view('users.search')->with([
            'players' => User::where('name', 'LIKE', "%" . $request->input('query') . "%")->get()
        ]);
    }
}
