<?php

namespace App\Services;

use App\Traits\ZktecoFetchTrait;

class ZktecoService
{
    use ZktecoFetchTrait;

    public function syncAttendance(): array
    {
        $deviceIp = config('zkteco.device_ip');
        $devicePort = config('zkteco.device_port');

        return $this->fetchAttendance($deviceIp, $devicePort);
    }
}
