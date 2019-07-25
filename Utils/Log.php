<?php
/**
 * Created by PhpStorm.
 * User: majid
 * Date: 7/23/19
 * Time: 11:58 PM
 */

namespace Utils;

class Log
{
    public static $instance;

    private const BLUE_COLOR = '[0;34m';
    private const GREEN_COLOR = '[0;32m';
    private const RED_COLOR = '[0;31m';

    /**
     * Log constructor.
     */
    public function __construct()
    {
        self::$instance = new self();
    }


    static public function info($message)
    {
        self::output(self::BLUE_COLOR . $message);
    }

    static public function error($message)
    {
        self::output(self::RED_COLOR . $message);
    }

    static public function success($message)
    {
        self::output(self::GREEN_COLOR . $message);
    }

    static private function output($body)
    {
        file_put_contents('php://stdout', "\n" . $body);
    }
}