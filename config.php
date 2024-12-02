<?php

class config
{

    public static function getConnexion()
    {
        try {
            $pdo = new PDO(
                'mysql:host=127.0.0.1;dbname=recette',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            echo " ";
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }

        return $pdo;
    }
}
?>
