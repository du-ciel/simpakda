<?php

use Carbon\CarbonInterface;

if (! function_exists('diff_for_humans_id')) {
    /**
     * Format a date difference in Indonesian.
     *
     * Laravel may be configured to return either Carbon or CarbonImmutable
     * instances for date casts, so accept their shared interface.
     */
    function diff_for_humans_id(CarbonInterface $date): string
    {
        // Compare calendar days so a date that is yesterday/tomorrow is always
        // reported as one day, regardless of the current time of day.
        $diff = (int) abs(now()->startOfDay()->diffInDays($date->startOfDay()));

        if ($date->isPast()) {
            if ($diff == 0) {
                return 'hari ini';
            }
            if ($diff == 1) {
                return '1 hari lalu';
            }
            if ($diff < 7) {
                return $diff.' hari lalu';
            }
            if ($diff < 30) {
                return floor($diff / 7).' minggu lalu';
            }
            if ($diff < 365) {
                return floor($diff / 30).' bulan lalu';
            }

            return floor($diff / 365).' tahun lalu';
        }

        if ($diff == 0) {
            return 'hari ini';
        }
        if ($diff == 1) {
            return '1 hari lagi';
        }
        if ($diff < 7) {
            return $diff.' hari lagi';
        }
        if ($diff < 30) {
            return floor($diff / 7).' minggu lagi';
        }
        if ($diff < 365) {
            return floor($diff / 30).' bulan lagi';
        }

        return floor($diff / 365).' tahun lagi';
    }
}
