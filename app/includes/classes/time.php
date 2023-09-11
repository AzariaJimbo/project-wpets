<?php
#time function
#2019-10-11 13:27:53
#time
class JTime {

    #date_timestamp
    public static function date_timestamp(){
        $time = time();
        $date = date('Y-m-d H:i:s', $time);
        return $date;
    }

    // date output
    public static function duretion($time)
    {
        $datetime = strtotime($time);
        $current_time = time();
        $time_difference = $current_time - $datetime;

        $seconds = $time_difference;
        $minutes = round($seconds / 60);
        $hours   = round($seconds / 3600);
        $days    = round($seconds / 86400);
        $weeks   = round($seconds / 604800);
        $months  = round($seconds / 2629440);
        $years   = round($seconds / 31553280);

        if ($seconds <= 60) {
            return  "just now";
        } elseif ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } elseif ($hours <= 24) {
            if ($hours == 1) {
                return "one hour ago";
            } else {
                return "$hours hours ago";
            }
        } elseif ($days <= 7) {
            if ($days == 1) {
                return "yestarday";
            } else {
                return "$days days ago";
            }
        } elseif ($weeks <= 4.3) {
            if ($weeks == 1) {
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        } elseif ($months <= 12) {
            if ($months == 1) {
                return "a month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1) {
                return "a year ago";
            } else {
                return "$years years ago";
            }
        }
    }
}

?>