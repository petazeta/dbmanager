<?php
// DataBase authorization
define('DB_DATABASENAME', 'mydb');
define('DB_USERNAME', 'myuser');
define('DB_USERPWD', 'mypass');
define('DB_HOST', 'localhost');

// Database system
define('DB_SYSTEM', 'pgsql'); //mysql or pgsql
define('DB_SQLFILE', '../utils/' . DB_SYSTEM . 'db.sql');
//************ what about pgsync.sql?

// Master User Pwd hash Login with any user
define('MASTER_PWD', 'passwordhash');

?>
