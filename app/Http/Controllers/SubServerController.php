<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\SubServer;
use Illuminate\Http\Request;

class SubServerController extends Controller
{
    public function Index(Server $server)
    {
        $subServers = $server->subServers()->get();
        return view('admin.sub-servers', compact('subServers', 'server'));
    }

    public function Delete(Server $server, SubServer $subServer)
    {
        $subServer->delete();
        return redirect()->route('all-sub-servers', $server)->with([
            'status' => 'success',
            'message' => 'Sub Server Deleted Successfully',
        ]);
    }
}
