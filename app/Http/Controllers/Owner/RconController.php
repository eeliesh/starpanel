<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;

use xPaw\SourceQuery\SourceQuery;

class RconController extends Controller
{
    public function index()
    {
        return view('owner.rcon.index');
    }

    public function execute(Request $request)
    {
        $query = new SourceQuery();

        try {
            $query->Connect(config('app.cs_server_ip'), config('app.cs_server_port'), 3, SourceQuery::GOLDSOURCE);
            $query->SetRconPassword(config('app.cs_rcon_pass'));
            $rconResponse = $query->Rcon($request->input('command'));
        }
        catch (Exception $e) {
            abort(403);
        }
        finally {
            $query->Disconnect();
        }

        return redirect()->back()->with([
            'rconResponse' => $rconResponse
        ]);
    }
}
