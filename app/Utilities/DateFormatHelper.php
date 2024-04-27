<?php
/**
 * DateFormat Helper Class
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */
namespace App\Utilities;

class DateFormatHelper
{
    /**
     * date formatter for checking how many minutes or weeks went by
     *
     * @param string $date date string
     *
     * @return false|string
     */
    public static function formatDate($date)
    {
        // Get the current timestamp and the timestamp of the given date
        $currentTimestamp = time();
        $postTimestamp = strtotime($date);

        // Calculate the difference in seconds
        $difference = $currentTimestamp - $postTimestamp;

        // If the difference is less than 60 seconds, return "Just now"
        if ($difference < 60) {
            return 'Just now';
        }

        // Calculate the difference in minutes
        $minutesDifference = floor($difference / 60);

        // If the difference is less than 60 minutes, return the difference in minutes
        if ($minutesDifference < 60) {
            return $minutesDifference . ' minutes ago';
        }

        // Calculate the difference in hours
        $hoursDifference = floor($minutesDifference / 60);

        // If the difference is less than 24 hours, return the difference in hours
        if ($hoursDifference < 24) {
            return $hoursDifference . ' hours ago';
        }

        // Calculate the difference in days
        $daysDifference = floor($hoursDifference / 24);

        // If the difference is less than 21 days, return the difference in days
        if ($daysDifference < 21) {
            return $daysDifference . ' days ago';
        }

        // If older than 21 days, return the date in the format "M d, Y"
        return date('M d, Y', $postTimestamp);
    }
}