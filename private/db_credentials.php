<?php
//Create database connection
//keep database credentials in a separate file
//1. Easy to exclude this file from source code managers
//2. Unique credentials on development and production servers
//3. Unique credentials if working with multiple developers


define("DB_SERVER", "localhost");

//localhost
define("DB_USER","webuser");
define("DB_PASS","secretpassword");
define("DB_NAME", "final_my_guitar_shop");

//huskusites
//define("DB_USER", "evelyngu_webuser");
//define("DB_PASS", "z,kfYER*JN42");
//define("DB_NAME", "evelyngu_chain_gang");


?>