<?php

class Database {

    private static $_singleton_instance;

    private function __construct() {
        
    }

    public static function init() {
        if (isset(self::$_singleton_instance))
            return self::$_singleton_instance;

        $ini = parse_ini_file('config.ini', false);
        $dbHost = $ini['dbHost'];
        $dbUser = $ini['dbUser'];
        $dbName = $ini['dbName'];
        $dbPass = $ini['dbPass'];
        self::$_singleton_instance = DbSimple_Generic::connect("mysql://{$dbUser}:{$dbPass}@{$dbHost}/{$dbName}");
        self::$_singleton_instance->setErrorHandler('databaseErrorHandler');
        self::$_singleton_instance->query("SET NAMES 'utf8'");

        // Код обработчика ошибок SQL.
        function databaseErrorHandler($message, $info) {
            // Если использовалась @, ничего не делать.
            if (!error_reporting())
                return;
            // Выводим подробную информацию об ошибке.
            echo "SQL Error: $message<br><pre>";
            print_r($info);
            echo "</pre>";
            exit();
        }

        return self::$_singleton_instance;
    }

}

?>
