<?php

error_reporting(0);
$conn = mysql_connect('localhost', 'usrbk2', 'pwbk2')
    or die('Could not connect: ' . mysql_error());
mysql_select_db('dbbk2') or die('Could not select database');
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

?>