<?php
$db = parse_ini_file("../Config/db.ini");

$mys = new \mysqli($db['host'],$db['username'],$db['password'],$db['dbname']);

if($mys->connect_error){
  echo "\nDatabase test not found\nCreating database\n";
  $conn = new \mysqli($db['host'],$db['username'],$db['password']);
  $sql = "CREATE DATABASE test";
  $conn->query($sql);
  $conn->close();
  echo "Database created, connecting...\n";
  $mys = new \mysqli($db['host'],$db['username'],$db['password'],$db['dbname']);
}

echo "Scanning for sql scripts\n";
$files = scandir('.');
$matching = preg_grep('/.*\.(sql)/', $files);

echo "\nFound ".count($matching)." scripts:\n\n";

foreach ($matching as $value) {
  echo "   Running $value ";
  exec('mysql -u'.$db['username'].' -p'.$db['password'].' '.$db['dbname'].' < '.$value);
  echo 'mysql -u'.$db['username'].' -p'.$db['password'].' '.$db['dbname'].' < '.$value;
}

echo "\n";
