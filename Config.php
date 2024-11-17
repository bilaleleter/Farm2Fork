<?php

declare(strict_types=1);

class Config
{
    private static $pdo = null;

    public static function getConnection(): PDO
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    "mysql:host=localhost;dbname=gestion_commande;",
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    ]
                );
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
