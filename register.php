<?php
include('config\config.php');

function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $email = '';
    $password = '';
    $phone = '';
    $country = '';
    $city = '';
    $address = '';
    $first_name = '';
    $last_name = '';
    $farm_name = '';
    $farm_owner_name = '';
    $gender = '';

    if ($role == '1') {
        // donnée mtaa aggriculteur
        $farm_name = $_POST['nom_ferme_agri'];
        $farm_owner_name = $_POST['nom_prop_agri'];
        $email = $_POST['email_agri'];
        $password = $_POST['mdp_agri'];
        $phone = $_POST['phone_agri'];
        $country = $_POST['country_agri'];
        $city = $_POST['city_agri'];
        $address = $_POST['address_agri'];

    } elseif ($role == '2') {
        // donnée mtaa Consommateur 
        $first_name = $_POST['nom_cons'];
        $last_name = $_POST['prenom_cons'];
        $email = $_POST['email_cons'];
        $password = $_POST['password_cons'];
        $phone = $_POST['phone_cons'];
        $country = $_POST['country_cons'];
        $city = $_POST['city_cons'];
        $address = $_POST['address_cons'];
        $gender = $_POST['gender_cons'];
    }

    try {
        $db = config::getConnexion();
        if ($role == '1') {
            $sql = "INSERT INTO Utilisateurs (role_id, email,pwd, phone_number, country, city, addr) 
                    VALUES (:role, :email, :password, :phone, :country, :city, :address)";
            try {

                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':role' => $role,
                    ':email' => $email,
                    ':password' => hashPassword($password),
                    ':phone' => $phone,
                    ':country' => $country,
                    ':city' => $city,
                    ':address' => $address,
                ]);

            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
            try {

                $userId = $db->lastInsertId();
                $farmSql = "INSERT INTO Agriculteurs (user_id, farm_name, farm_owner_name) 
                        VALUES (:user_id, :farm_name, :farm_owner_name)";
                $farmStmt = $db->prepare($farmSql);
                $farmStmt->execute([
                    ':user_id' => $userId,
                    ':farm_name' => $farm_name,
                    ':farm_owner_name' => $farm_owner_name
                ]);
                echo "Aggriculteur Account successfully created!";
            } catch (Exception $e) {
                echo '' . $e->getMessage();
            }

        } elseif ($role == '2') {
            $sql = "INSERT INTO Utilisateurs (role_id, email, pwd, phone_number, country, city, addr) 
                    VALUES (:role, :email, :password, :phone, :country, :city, :address)";
            try {

                $stmt = $db->prepare($sql);
                $stmt->execute([
                    ':role' => $role,
                    ':email' => $email,
                    ':password' => hashPassword($password),
                    ':phone' => $phone,
                    ':country' => $country,
                    ':city' => $city,
                    ':address' => $address
                ]);
            } catch (Exception $e) {
                echo "here";
                echo '' . $e->getMessage();
            }
            try {
                $userId = $db->lastInsertId();
                $consSql = "INSERT INTO Consomateurs(user_id, genre) 
                        VALUES (:user_id, :genre)";
                $consStmt = $db->prepare($consSql);
                $consStmt->execute([
                    ':user_id' => $userId,
                    ':genre' => $gender
                ]);
                
                echo "Consomateur Account successfully created!";
            } catch (Exception $e) {
                echo '' . $e->getMessage();
            }
        }

    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
?>