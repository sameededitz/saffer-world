<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;

class UserDeviceController extends Controller
{
    public function index(User $user)
    {
        $devices = $user->devices;
        return view('admin.all-devices-user', compact('devices', 'user'));
    }

    public function delete(UserDevice $device)
    {
        $device->delete();
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Device deleted successfully',
        ]);
    }
}
