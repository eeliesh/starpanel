<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use xPaw\SourceQuery\SourceQuery;
use Exception;

use App\Models\StaffLog;

class HomeController extends Controller
{
    public function index()
    {
        // $timer = microtime(true);
        $query = new SourceQuery();
        $info = [];
        
        try {
            $query->Connect(config('app.cs_server_ip'), config('app.cs_server_port'), 3, SourceQuery::SOURCE);
            $info = $query->GetInfo();
        }
        catch (Exception $e) {
            $exception = $e;
        }
        finally {
            $query->Disconnect();
        }

        // $timer = number_format(microtime(true) - $timer, 4, '.', '');

        return view('home.index')->with([
            'server_info' => $info,
            'server_ip' => config('app.cs_server_ip'),
            'staff_logs' => StaffLog::orderBy('created_at', 'DESC')->take(10)->get(),
        ]);
    }
}
