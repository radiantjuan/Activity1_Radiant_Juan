<?php
/**
 * View renderer
 *
 * @author    Radiant C. Juan <K230925@Student.kent.edu.au>
 * @copyright 2024 Radiant Juan - K230925
 */

namespace App\Config\Views;

class View
{
    protected static $data = [];

    /**
     * Renders the view based on path indicated in the controller
     *
     * @param string $view view file name
     * @param array  $data additional data to be rendered in the view
     *
     * @return void
     */
    public static function render($view, $data = [])
    {
        self::$data = $data; // Set data for the view
        $viewPath = self::getViewPath($view); // Get the path to the view file
        if ($viewPath !== false) {
            ob_start(); // Start output buffering
            include $viewPath; // Include the view file
            $content = ob_get_clean(); // Get the buffered content and clean the buffer
            include '../app/Views/layout.php'; // Include the layout file
        } else {
            echo "Views '$view' not found.";
        }
    }

    /**
     * file path validation
     *
     * @param string $view view file path
     *
     * @return false|string
     */
    protected static function getViewPath($view)
    {
        $viewFile = "../app/Views/{$view}.php";
        return file_exists($viewFile) ? $viewFile : false;
    }

    public static function getData($key = null)
    {
        if ($key === null) {
            return self::$data;
        }
        return isset(self::$data[$key]) ? self::$data[$key] : null;
    }

    /**
     * Data to be rendered in view
     *
     * @param string $key   data attribute name
     * @param string $value data value
     *
     * @return void
     */
    public static function setData($key, $value)
    {
        self::$data[$key] = $value;
    }
}
