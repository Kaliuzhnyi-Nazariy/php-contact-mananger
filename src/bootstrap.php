<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');

$dotenv->load();

session_start();

$pdo = require __DIR__ ."/../src/db.php";