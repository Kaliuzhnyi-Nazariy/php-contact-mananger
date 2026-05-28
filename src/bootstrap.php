<?php

require __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../')->safeLoad();

session_start();

$pdo = require __DIR__ ."/../src/db.php";