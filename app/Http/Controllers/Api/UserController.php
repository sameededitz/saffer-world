<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function registerDevice(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'device_name' => 'required',
            'device_token' => 'nullable',
            'device_id' => 'required',
            'platform' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->all()
            ], 400);
        }

        $deviceId = $request->device_id;
        $devicedetails = [
            'device_name' => $request->device_name,
            'device_id'   => $deviceId,
            'device_token' => $request->device_token,
            'ip_address'  => $request->ip(),
            'platform'    => $request->platform,
        ];
        /** @var \App\Models\User $user **/
        $user = Auth::user();

        if ($user->canRegisterDevice($deviceId)) {
            $user->registerDevice($deviceId, $devicedetails);
            return response()->json([
                'status' => true,
                'message' => 'Device registered successfully.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'You have reached the maximum number of devices allowed. Please remove a device to add a new one.'
            ], 403);
        }
    }

    public function AllDevices()
    {
        $user = Auth::user();
        /** @var \App\Models\User $user */
        $devices = $user->devices;

        return response()->json([
            'status' => true,
            'devices' => $devices
        ], 200);
    }

    public function deleteDevice(Request $request)
    {
        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $device = $user->devices()->where('device_id', $request->device_id)->first();
        if (!$device) {
            return response()->json([
                'status' => false,
                'message' => 'Device not found or does not belong to the user.',
            ], 404);
        }
        $device->delete();

        return response()->json([
            'status' => true,
            'message' => 'Device deleted successfully.',
        ], 200);
    }

    public function checkDevice(Request $request)
    {
        // Validate the request data
        $request->validate([
            'device_id' => 'required|string',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check if the device exists for the authenticated user
        $deviceExists = $user->devices()->where('device_id', $request->device_id)->exists();

        if ($deviceExists) {
            return response()->json([
                'status' => true,
                'message' => 'Device is registered.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Device not found.',
            ], 404);
        }
    }
}
