<?php
$pdo = require 'conection.php';
$statement = $pdo->query('select * from users');
print_r($statement->fetchAll());