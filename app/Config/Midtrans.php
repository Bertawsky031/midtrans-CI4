<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Midtrans extends BaseConfig
{
    public $serverKey = 'SB-Mid-server-B6UkrbL4S4gaWqaEmWh25Z1f';
    public $clientKey = 'SB-Mid-client-5bGj-aARFfmK9QbN';
    public $isProduction = false; // Ubah ke true saat di produksi
    public $isSanitized = true;
    public $is3ds = true;
}