<?php
//==php new pdo sqlite google it===
try
{
    //open the database
    $db = new PDO('sqlite:database.db');


 $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}   catch (Exception $e) {
    echo "Unable to connect";
    echo $e->getMessage();
    exit;
}
//echo "Connected to the database";
    //create the database
	
/*
    $db->exec("CREATE TABLE `users` (
  `id` INTEGER PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `dot` varchar(50) NOT NULL,
  `ptime` varchar(50) NOT NULL,
  `nop` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `notes` varchar(50) NOT NULL
)");   

  */  
