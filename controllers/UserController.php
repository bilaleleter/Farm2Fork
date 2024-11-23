<?php
include_once(__DIR__ . '/../core/config.php');
include(__DIR__ . '/../models/UserModel.php');

class UserController
{
    private $db;

    public function __construct()
    {
        $this->db = config::getConnexion();
    }

    // List all users
    public function listUsers()
    {
        $sql = "SELECT * FROM Utilisateur";
        try {
            $list = $this->db->query($sql);
            return $list;
        } catch (PDOException $e) {
            return false;
            //die('Error: ' . $e->getMessage());
        }
    }

    // Delete a user
    public function deleteUser($user_id)
    {
        $sql = "DELETE FROM Utilisateur WHERE user_id = :user_id";
        $req = $this->db->prepare($sql);
        $req->bindValue(':user_id', $user_id);

        try {
            return $req->execute();
        } catch (PDOException $e) {
            return false;
            //die('Error: ' . $e->getMessage());
        }
    }

    // Add a new user
    public function addUser(UserModel $user)
    {
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        //var_dump($user);

        $sql = "INSERT INTO Utilisateur (role_id, email, password, phone_number, country, city, address, profile_pic, farm_name, farm_description, genre, nom_consomateur, prenom_consomateur, farm_owner_name) VALUES (:role_id, :email, :password, :phone_number, :country, :city, :address, :profile_pic, :farm_name, :farm_description, :genre, :nom_consomateur, :prenom_consomateur, :farm_owner_name)";
        try {
            $query = $this->db->prepare($sql);
            return $query->execute([
                'role_id' => $user->getRoleId(),
                'email' => $user->getEmail(),
                'password' => $hashedPassword,
                'phone_number' => $user->getPhoneNumber(),
                'country' => $user->getCountry(),
                'city' => $user->getCity(),
                'address' => $user->getAddress(),
                'profile_pic' => $user->getProfilePic(),
                'farm_name' => $user->getFarmName(),
                'farm_description' => $user->getFarmDescription(),
                'genre' => $user->getGenre(),
                'nom_consomateur' => $user->getNomConsomateur(),
                'prenom_consomateur' => $user->getPrenomConsomateur(),
                'farm_owner_name' => $user->getFarmOwnerName(),
            ]);
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return "Database error: " . $e->getMessage();
        }
    }

    // Update an existing user
    public function updateUser(UserModel $user, $user_id)
    {
        var_dump($user);

        $sql = "UPDATE Utilisateur SET role_id = :role_id, email = :email, password = :password, phone_number = :phone_number, country = :country, city = :city, address = :address, profile_pic = :profile_pic, farm_name = :farm_name, farm_description = :farm_description, genre = :genre, nom_consomateur = :nom_consomateur, prenom_consomateur = :prenom_consomateur, farm_owner_name=:farm_owner_name WHERE user_id = :user_id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([
                'user_id' => $user_id,
                'role_id' => $user->getRoleId(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'phone_number' => $user->getPhoneNumber(),
                'country' => $user->getCountry(),
                'city' => $user->getCity(),
                'address' => $user->getAddress(),
                'profile_pic' => $user->getProfilePic(),
                'farm_name' => $user->getFarmName(),
                'farm_description' => $user->getFarmDescription(),
                'genre' => $user->getGenre(),
                'nom_consomateur' => $user->getNomConsomateur(),
                'prenom_consomateur' => $user->getPrenomConsomateur(),
                'farm_owner_name'=> $user->getFarmOwnerName()
            ]);
        } catch (PDOException $e) {
            return false;
            //die('Error: ' . $e->getMessage());
        }
    }

    // Retrieve a single user details
    public function showUser($user_id)
    {
        $sql = "SELECT * FROM Utilisateur WHERE user_id = :user_id";
        try {
            $query = $this->db->prepare($sql);
            $query->execute([':user_id' => $user_id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            return false;
            //die('Error: ' . $e->getMessage());
        }
    }
    public function isEmailExists(string $email): bool {
        try {
            $sql = "SELECT COUNT(*) FROM Utilisateur WHERE lower(email) = lower(:email)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            return false; 
        }
    }
    public function getLastInsertId() {
        return $this->db->lastInsertId();
    }
    
    public function getUserByEmail($email) {
        $query = "SELECT * FROM Utilisateur WHERE lower(email) = lower(:email) LIMIT 1";
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user ? $user : null;
        } catch (PDOException $e) {
            // Optionally handle the error specifically
            error_log("Error in getUserByEmail: " . $e->getMessage());
            
            return null;
        }
    }
    
    
}
