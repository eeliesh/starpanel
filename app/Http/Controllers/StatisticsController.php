<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use xPaw\SourceQuery\SourceQuery;
use Exception;

use App\Models\User;

class StatisticsController extends Controller
{
    public function online()
    {
        $query = new SourceQuery();
        $players = [];

        try {
            $query->Connect(config('app.cs_server_ip'), config('app.cs_server_port'), 3, SourceQuery::SOURCE);
            $players = $query->GetPlayers();
        }
        catch (Exception $e) {
            $exception = $e;
        }
        finally {
            $query->Disconnect();
        }

        $sort_col = array();
        foreach ($players as $key => $row) {
            $sort_col[$key] = $row['Time'];
        }
        array_multisort($sort_col, SORT_ASC, $players);

        return view('stats.online')->with([
            'players' => $players,
        ]);
    }

    public function top()
    {
        return view('stats.top')->with([
            'players' => User::orderBy('headshots', 'DESC')->take(15)->get(),
        ]);
    }

    public function bans()
    {
        return view('stats.bans');
    }
}
