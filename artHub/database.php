<?php
	/* ---------------------------------------------------------------------------
	* filename    : database.php
	* description : allows connection to database tables.
	* ---------------------------------------------------------------------------
	*/

class Database
{
    private static $dbName = 'mmmunroe' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'mmmunroe';
    private static $dbUserPassword = 'dumb_password';

    private static $cont  = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }

}
?>

