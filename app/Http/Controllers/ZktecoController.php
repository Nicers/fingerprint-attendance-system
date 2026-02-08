<?php

namespace App\Http\Controllers;

use App\Services\ZktecoService;

class ZktecoController extends Controller
{
    public function sync(ZktecoService $service)
    {
        $data = $service->syncAttendance();

        if (empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Device connection failed'
            ], 500);
        }

        return response()->json([
            'status' => true,
            'users_count' => count($data['users']),
            'attendance_count' => count($data['attendance']),
        ]);
    }
}
