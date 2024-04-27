<?php
/**
 * Debugging Helper Class
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Utilities;

class DebugHelper
{
    /**
     * Print the variable data and kill the process
     *
     * @param mixed $data data to be passed
     *
     * @return void
     */
    public static function dump_and_die($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die;
    }

    /**
     * Print the variable data
     *
     * @param mixed $data data to be passed
     *
     * @return void
     */
    public static function dump($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}