<?php

	/** Connects to the database. Classes that query the database should extend this class.
	 *
	 */
     class DatabaseConnector {
        const hostname = "tethys.cse.buffalo.edu";
        const dbusername = "aepellec";
        const dbpassword = "50285732";
        const dbName = "cse442_542_2019_summer_teamb_db";
        static $conn;

       //Returns the database instance that can be used to make queries
        protected static function getDB(){
            if(self::$conn === null){
                self::$conn = mysqli_connect(self::hostname, self::dbusername, self::dbpassword, self::dbName) or die('Unable to connect');
                mysqli_set_charset(self::$conn,'utf8');

                if (self::$conn->connect_error) {
                  echo "errorrrr";
                }
            }

            return self::$conn;
        }
    }
?>
