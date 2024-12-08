<?php
class config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            $servername = "localhost"; // Doit être 'localhost' pour XAMPP
            $username = "root"; // Par défaut sous XAMPP
            $password = ""; // Vide par défaut sous XAMPP
            $dbname = "web"; // Nom exact de la base de données

            try {
                self::$pdo = new PDO(
                    "mysql:host=$servername;dbname=$dbname",
                    $username,
                    $password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                // Log l'erreur dans un fichier (optionnel)
                error_log($e->getMessage(), 3, 'errors.log');
                die('Erreur : Impossible de se connecter à la base de données.');
            }
        }
        return self::$pdo;
    }
}
