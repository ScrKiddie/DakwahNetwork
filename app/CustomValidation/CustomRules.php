<?php

namespace App\CustomValidation;

use DateTime;
use DateTimeZone;

class CustomRules
{
    /**
     * @throws \Exception
     */
    public function checkDateTimeFormat($value, ?string &$error = null)
    {
        $format = 'Y-m-d\TH:i';
        $dateTime = DateTime::createFromFormat($format, $value);
        if ($dateTime && $dateTime->format($format) === $value) {
            $now = time();
            $dateTime = new DateTime($value, new DateTimeZone('Asia/Jakarta'));
            $dateTime->setTimezone(new DateTimeZone('UTC'));
            $givenDateTime = $dateTime->getTimestamp();
            if ($givenDateTime >= $now) {
                return true;
            } else {
                $error = "Waktu mulai tidak boleh kurang dari waktu saat ini.";
                return false;
            }
        } else {
            $error = "Waktu mulai harus sesuai format Y-m-d\TH:i.";
            return false;
        }
    }

    public function checkDuration($value, ?string &$error = null)
    {
        if ($value >= 30) {
            return true;
        } else {
            $error = "Isi durasi minimal 30 menit.";
            return false;
        }
    }

}