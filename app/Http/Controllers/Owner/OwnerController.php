<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\App;

use App\Models\User;
use App\Models\Admin;

use xPaw\SourceQuery\SourceQuery;

class OwnerController extends Controller
{
    public function index()
    {
        $query = new SourceQuery();
        $players = [];

        try {
            $query->Connect(config('app.cs_server_ip'), config('app.cs_server_port'), 3, SourceQuery::GOLDSOURCE);
            $query->SetRconPassword(config('app.cs_rcon_pass'));
            $players = $query->GetPlayers();
            $banned_players = substr_count($query->Rcon('listip'), ':') - 1;
        }
        catch (Exception $e) {
            abort(403);
        }
        finally {
            $query->Disconnect();
        }

        return view('owner.index')->with([
            'total_users' => User::count(),
            'total_admins' => Admin::count(),
            'online_players' => count($players),
            'banned_players' => $banned_players
        ]);
    }

    public function maintenance()
    {
        $message = '';

        if (App::isDownForMaintenance()) {
            $message = 'The application is now live.';
            Artisan::call('up');
        } else {
            $message = 'The application is now down for maintenance.';
            Artisan::call('down --secret="ACTIVATEGODM0D3"');
        }

        return redirect(route('owner.index'))->with([
            'message' => $message,
            'message-type' => 'success'
        ]);
    }
}
