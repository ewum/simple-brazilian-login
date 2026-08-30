<?php
$pdo = new PDO("mysql:host=mysql;dbname=mydb", "root", "1234");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
