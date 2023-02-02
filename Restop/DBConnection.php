<?php
session_start();

/*if(!is_dir(__DIR__.'./db'))
    mkdir(__DIR__.'./db');
if(!defined('db_file')) define('db_file',__DIR__.'./db/table_resrvation_db.db');
if(!defined('tZone')) define('tZone',"Asia/Manila");
if(!defined('dZone')) define('dZone',ini_get('date.timezone'));
function my_udf_md5($string) {
    return md5($string);
}*/

Class DBConnection{
    //protected $db;
    function __construct(){
        /*$this->open(db_file);
        $this->createFunction('md5', 'my_udf_md5');
        $this->exec("PRAGMA foreign_keys = ON;");

        $this->exec("CREATE TABLE IF NOT EXISTS `admin_list` (
            `admin_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
            `fullname` INTEGER NOT NULL,
            `username` TEXT NOT NULL,
            `password` TEXT NOT NULL,
            `status` INTEGER NOT NULL Default 1,
            `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        $this->exec("CREATE TABLE IF NOT EXISTS `table_list` (
            `table_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
            `tbl_no` INTEGER NOT NULL,
            `name` INTEGER NOT NULL,
            `description` INTEGER NOT NULL,
            `coordinates` TEXT NOT NULL,
            `status` INTEGER NOT NULL Default 1,
            `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        $this->exec("CREATE TABLE IF NOT EXISTS `reservation_list` (
            `reservation_id` INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
            `customer_name` TEXT NOT NULL,
            `contact` TEXT NOT NULL,
            `email` TEXT NOT NULL,
            `address` TEXT NOT NULL,
            `table_id` INTEGER NOT NULL,
            `datetime` TIMESTAMP NOT NULL,
            `status` INTEGER NOT NULL Default 0,
            `date_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // $this->exec("CREATE TRIGGER IF NOT EXISTS updatedTime_task AFTER UPDATE on `task_list`
        // BEGIN
        //     UPDATE `task_list` SET date_updated = CURRENT_TIMESTAMP where task_id = task_id;
        // END
        // ");

        $this->exec("INSERT or IGNORE INTO `admin_list` VALUES (1,'Administrator','admin',md5('admin123'),1, CURRENT_TIMESTAMP)");
*/

    }
    /*function __destruct(){
         $this->close();
    }*/
    public function connect()
	{
    $host = "localhost";
                $userName = "root";
                $password = "";
                $dbName = "restop_db";
                $conn=new mysqli($host, $userName, $password, $dbName);

		return $conn;
	}

}
