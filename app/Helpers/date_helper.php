<?php
if (!function_exists('get_weeks_in_month')) {
    function get_weeks_in_month($month, $year)
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $weeks = [];
        $currentWeek = 1;
        $currentWeekDays = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = "$year-$month-$day";
            $dayOfWeek = date('N', strtotime($date)); // 1 (Senin) - 7 (Minggu)
            $dayName = date('l', strtotime($date)); // Nama hari

            // Hanya tambahkan hari kerja (Senin - Jumat)
            if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                $currentWeekDays[] = ["date" => $date, "day_name" => $dayName, "day" => $day];
            }

            // Jika hari Jumat, akhiri minggu dan mulai minggu baru
            if ($dayOfWeek == 5 || $day == $daysInMonth) {
                $weeks[] = ["week" => $currentWeek, "days" => $currentWeekDays];
                $currentWeek++;
                $currentWeekDays = [];
            }
        }

        return $weeks;
    }
}

if (!function_exists('get_weekend_in_month')) {
    function get_weekend_in_month($month, $year)
    {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $weekends = [];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $date = "$year-$month-$day";
            $dayOfWeek = date('N', strtotime($date)); // 1 (Senin) - 7 (Minggu)

            // Hanya tambahkan hari libur (Sabtu - Minggu)
            if ($dayOfWeek >= 6 && $dayOfWeek <= 7) {
                $weekends[] = ["date" => $date, "day" => $day];
            }
        }

        return $weekends;
    }
}
