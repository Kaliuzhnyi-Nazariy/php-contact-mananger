<?php
try {
    $dblink = __DIR__ . '/../storage/contact-manager.db';
    // $dblink = __DIR__ . '/contact-manager.db';
    // $dblink = 'contact-manager.db';
    $pdo = new PDO("sqlite:$dblink");
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec(' CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, name TEXT NOT NULL, email TEXT UNIQUE NOT NULL, password TEXT NOT NULL);
    
    CREATE TABLE IF NOT EXISTS contacts (id INTEGER PRIMARY KEY, name TEXT NOT NULL, email TEXT, phone TEXT, photo TEXT, owner_id INTEGER NOT NULL, FOREIGN KEY(owner_id) REFERENCES users(id))
    ');

    return $pdo;
} catch (Exception $e) {
    return null;
}
?>