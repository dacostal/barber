<?php

namespace App\Service;

class TimeFormatter
{
    /**
     * @param string $time
     * @return string
     */
    public function format(string $time): string
    {
        $time = explode(':', $time);

        $hours = substr($time[0], 1, 1);
        $minutes = $time[1];

        if($hours === "0"){
            return $minutes."min";
        }

        return $hours."h".$minutes."min";
    }
}
