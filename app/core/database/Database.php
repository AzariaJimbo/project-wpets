<?php
// Database config
class Database {
    //properties
    private static $host = 'localhost';
    private static $db_name = 'wpets';
    private static $username = 'root';
    private static $password = '';
    private static $conn;

    // constructor
    function __construct()
    {
        // initialize it to null
        self::$conn = null;
    }

    // connection function
    public static function connect ()
    {
        try {
            $dns = 'mysql:host=' . self::$host . ';dbname=' . self::$db_name;
            self::$conn = new PDO($dns, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // fetch mode set to associative
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } 
        catch (PDOException $ex) {
            echo 'Connection Error: ' . $ex->getMessage();
        }

        return self::$conn;
    }
}