<?php
//SESSION HANDLING
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set("session.use_only_cookies", 1);
ini_set("session.use_strict_mode", 1);

class ConfigSession {
    public static function startSession() {
        session_set_cookie_params([
            "lifetime" => 1800,
            "domain" => "localhost",
            "path" => "/",
            "secure" => true,
            "httponly" => true
        ]);

        session_start();

        if (!isset($_SESSION["last_regeneration"])) {
            self::regenerateSessionId();
        } else {
            $interval = 60 * 30;
            if (time() - $_SESSION["last_regeneration"] >= $interval) {
                self::regenerateSessionId();
            }
        }
    }

    private static function regenerateSessionId() {
        session_regenerate_id(true);
        $_SESSION["last_regeneration"] = time();
    }
}
