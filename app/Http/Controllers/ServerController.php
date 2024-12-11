<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function Index()
    {
        $servers = Server::all();
        return view('admin.servers', compact('servers'));
    }

    public function AddServer()
    {
        return view('admin.add-server');
    }

    public function EditServer(Server $server)
    {
        return view('admin.edit-server', compact('server'));
    }

    public function DeleteServer(Server $server)
    {
        $server->clearMediaCollection('server_logo');
        $server->delete();
        return redirect()->route('all-servers')->with([
            'status' => 'success',
            'message' => 'Server Deleted Successfully',
        ]);
    }
    public function Status(Server $server)
    {
        $server->update([
            'status' => !$server->status,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Server Status Updated Successfully',
        ]);
    }
}
