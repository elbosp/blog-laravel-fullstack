<?php

namespace App\Library;

use Carbon\Carbon;

class Dates
{
    private static $params;

    private static $maps = [
        'days' => [
            'Monday' => 'Senin',
            'Sunday' => 'Ahad',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ],
        'months' => [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'Nopember',
            'December' => 'Desember'
        ]
    ];

    private static function get($element, $key) {
        return array_key_exists($key, static::$maps[$element]) ? static::$maps[$element][$key] : null;
    }

    public static function today()
    {
        static::$params = Carbon::today();

        return new static;
    }

    public static function convert($params)
    {
        static::$params = $params;

        return new static;
    }

    public static function ISO8601()
    {
        $date = Carbon::parse(static::$params)->format('d');
        $month = Carbon::parse(static::$params)->format('m');
        $year = Carbon::parse(static::$params)->format('Y');

        return empty(static::$params) ? null : "{$year}-{$month}-{$date}";
    }

    public static function readable()
    {
        $day = Carbon::parse(static::$params)->format('l');
        $date = Carbon::parse(static::$params)->format('j');
        $month = Carbon::parse(static::$params)->format('F');
        $year = Carbon::parse(static::$params)->format('Y');

        $day = static::get('days', $day);
        $month = static::get('months', $month);

        return empty(static::$params) ? null : "{$day}, {$date} {$month} {$year}";
    }
}
