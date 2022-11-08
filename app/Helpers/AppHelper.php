<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Options;

class AppHelper
{
    public function makeChartData($pageViewMonth)
    {
        $dataChart = [];
        for ($x = 0; $x < date('t'); $x++) {
            $count = 0;
            foreach ($pageViewMonth as $viewDays) {
                if (
                    Carbon::parse($viewDays->created_at)->format('d') ==
                    $x + 1
                ) {
                    $count++;
                }
            }
            $dataChart[] = [
                'date' => Carbon::parse(now())->format('Y-m-') . ($x + 1),
                'views' => $count,
            ];
        }
        return $dataChart;
    }
    public function updateOptions($name, $value)
    {
        if (!$value) {
            $value = '';
        }
        $setting = Options::where('name', $name)->first();
        if (!$setting) {
            if (is_array($value)) {
                $setting->create([
                    'name' => $name,
                    'value' => json_encode($value, true),
                ]);
                return $setting;
            }
            $setting->create([
                'name' => $name,
                'value' => $value,
            ]);
            return $setting;
        }
        if (is_array($value)) {
            $setting->update([
                'value' => json_encode($value, true),
            ]);
            return $setting;
        }
        $setting->update([
            'value' => $value,
        ]);
        return $setting;
    }
    public function getOptions($name)
    {
        $setting = Options::where('name', $name)->first();
        if (!$setting) {
            return '';
        }
        return $setting->value;
    }
    public function VerifyRecaptcha($response)
    {
        $ch = curl_init();
        curl_setopt(
            $ch,
            CURLOPT_URL,
            'https://www.google.com/recaptcha/api/siteverify'
        );
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $response,
            'remoteip' => $_SERVER['REMOTE_ADDR'],
        ]);

        $resp = json_decode(curl_exec($ch));
        curl_close($ch);
        return $resp->success;
    }
    public static function instance()
    {
        return new AppHelper();
    }
}
