<?php

namespace App\Services;

class QrisService {
    public function makeDynamic($staticString, $amount) {
        // 1. Bersihkan string dari spasi dan buang 4 digit CRC terakhir
        $payload = substr(trim($staticString), 0, -4);
        
        // 2. Kita cari Tag 58 (Mata Uang '5802ID') sebagai jangkar
        $pos58 = strpos($payload, '5802ID');
        
        if ($pos58 === false) return $staticString; // Jaga-jaga kalau string rusak

        // 3. Ambil bagian SEBELUM Tag 58
        $before58 = substr($payload, 0, $pos58);
        $after58 = substr($payload, $pos58);

        // 4. Kita bersihkan jika ada Tag 54 (Nominal) yang tepat berada sebelum Tag 58
        // (Agar tidak merusak Tag 54 palsu yang ada di tengah Merchant ID)
        $before58 = preg_replace("/54[0-9]{2}[0-9]+$/", "", $before58);

        // 5. Siapkan Tag Nominal Baru
        $val = (string)intval($amount);
        $len = str_pad(strlen($val), 2, "0", STR_PAD_LEFT);
        $newNominal = "54" . $len . $val;

        // 6. Gabungkan: [Data Merchant] + [Nominal Baru] + [Mata Uang & Seterusnya]
        $finalPayload = $before58 . $newNominal . $after58;

        // 7. Hitung CRC16 CCITT-FALSE
        return $finalPayload . $this->crc16($finalPayload);
    }

    private function crc16($payload) {
        $res = 0xFFFF;
        for ($i = 0; $i < strlen($payload); $i++) {
            $res ^= ord($payload[$i]) << 8;
            for ($j = 0; $j < 8; $j++) {
                $res = ($res & 0x8000) ? ($res << 1) ^ 0x1021 : ($res << 1);
            }
        }
        $res &= 0xFFFF;
        return strtoupper(str_pad(dechex($res), 4, '0', STR_PAD_LEFT));
    }
}