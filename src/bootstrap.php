<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('');

$dotenv->load();

session_start();

$pdo = require __DIR__ ."/../src/db.php";