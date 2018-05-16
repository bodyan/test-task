<?php
/**
* based on https://www.youtube.com/watch?v=eD_KAZXfAYc
*/
class Session {

    private static $_sessionStarted = false;

    public static function start() {
        if(self::$_sessionStarted == false) {
            session_start();
            self::$_sessionStarted = true;
        }
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }

    }

    public static function destroy() {
        session_destroy();
    }
}

?>
