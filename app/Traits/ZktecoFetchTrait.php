<?php

namespace App\Traits;

use Rats\Zkteco\Lib\ZKTeco;
use Illuminate\Support\Facades\Log;

trait ZktecoFetchTrait
{
    public function fetchAttendance(string $ip, int $port = 4370): array
    {
        $zk = new ZKTeco($ip, $port);

        if (! $zk->connect()) {
            Log::error("ZKTeco connection failed", ['ip' => $ip]);
            return [];
        }

        try {
            $zk->disableDevice();

            $users = $zk->getUser();
            $attendance = $zk->getAttendance();

            $zk->enableDevice();
            $zk->disconnect();

            return [
                'users' => $users,
                'attendance' => $attendance,
            ];
        } catch (\Throwable $e) {
            Log::error("ZKTeco error", [
                'ip' => $ip,
                'message' => $e->getMessage()
            ]);

            return [];
        }
    }
}
