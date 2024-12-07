<?php

class UserModel {
    private ?int $user_id;
    private ?int $role_id;
    private ?string $nom_consomateur;
    private ?string $prenom_consomateur;
    private ?string $phone_number;
    private ?string $email;
    private ?string $password;
    private ?string $country;
    private ?string $city;
    private ?string $address;
    private ?string $profile_pic;
    private ?DateTime $ban_until;
    private ?string $genre;
    private ?string $farm_pics;
    private ?string $farm_vids;
    private ?string $farm_name;
    private ?string $farm_description;

    private ?string $farm_owner_name;

    private ?string $faceId;
    // Constructor
    public function __construct(?int $user_id = null, ?int $role_id = null, ?string $nom_consomateur = null, ?string $prenom_consomateur = null,
                                ?string $phone_number = null, ?string $email = null, ?string $password = null, ?string $country = null, 
                                ?string $city = null, ?string $address = null, ?string $profile_pic = null, ?DateTime $ban_until = null, 
                                ?string $genre = null, ?string $farm_pics = null, ?string $farm_vids = null, ?string $farm_name = null, 
                                ?string $farm_description = null, ?string $farm_owner_name = null, ?string $faceId=null) {
        $this->user_id = $user_id;
        $this->role_id = $role_id;
        $this->nom_consomateur = $nom_consomateur;
        $this->prenom_consomateur = $prenom_consomateur;
        $this->phone_number = $phone_number;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->city = $city;
        $this->address = $address;
        $this->profile_pic = $profile_pic;
        $this->ban_until = $ban_until;
        $this->genre = $genre;
        $this->farm_pics = $farm_pics;
        $this->farm_vids = $farm_vids;
        $this->farm_name = $farm_name;
        $this->farm_description = $farm_description;
        $this->farm_owner_name = $farm_owner_name;
        $this->faceId = $faceId;
    }

    // Getters and setters for each property

    public function getUserId(): ?int {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void {
        $this->user_id = $user_id;
    }

    public function getRoleId(): ?int {
        return $this->role_id;
    }

    public function setRoleId(?int $role_id): void {
        $this->role_id = $role_id;
    }

    public function getNomConsomateur(): ?string {
        return $this->nom_consomateur;
    }

    public function setNomConsomateur(?string $nom_consomateur): void {
        $this->nom_consomateur = $nom_consomateur;
    }

    public function getPrenomConsomateur(): ?string {
        return $this->prenom_consomateur;
    }

    public function setPrenomConsomateur(?string $prenom_consomateur): void {
        $this->prenom_consomateur = $prenom_consomateur;
    }

    public function getPhoneNumber(): ?string {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): void {
        $this->phone_number = $phone_number;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getCountry(): ?string {
        return $this->country;
    }

    public function setCountry(?string $country): void {
        $this->country = $country;
    }

    public function getCity(): ?string {
        return $this->city;
    }

    public function setCity(?string $city): void {
        $this->city = $city;
    }

    public function getAddress(): ?string {
        return $this->address;
    }

    public function setAddress(?string $address): void {
        $this->address = $address;
    }

    public function getProfilePic(): ?string {
        return $this->profile_pic;
    }

    public function setProfilePic(?string $profile_pic): void {
        $this->profile_pic = $profile_pic;
    }

    public function getBanUntil(): ?DateTime {
        return $this->ban_until;
    }

    public function setBanUntil(?DateTime $ban_until): void {
        $this->ban_until = $ban_until;
    }

    public function getGenre(): ?string {
        return $this->genre;
    }

    public function setGenre(?string $genre): void {
        $this->genre = $genre;
    }

    public function getFarmPics(): ?string {
        return $this->farm_pics;
    }

    public function setFarmPics(?string $farm_pics): void {
        $this->farm_pics = $farm_pics;
    }

    public function getFarmVids(): ?string {
        return $this->farm_vids;
    }

    public function setFarmVids(?string $farm_vids): void {
        $this->farm_vids = $farm_vids;
    }

    public function getFarmName(): ?string {
        return $this->farm_name;
    }

    public function setFarmName(?string $farm_name): void {
        $this->farm_name = $farm_name;
    }

    public function getFarmDescription(): ?string {
        return $this->farm_description;
    }

    public function setFarmDescription(?string $farm_description): void {
        $this->farm_description = $farm_description;
    }
    public function getFarmOwnerName(): ?string {
        return $this->farm_owner_name;
    }

    public function setFarmOwnerName(?string $farm_owner_name): void {
        $this->farm_owner_name = $farm_owner_name;
    }
    public function getFaceId(): ?string {
        return $this->faceId;
    }

    public function setFaceId(?string $faceId): void {
        $this->faceId= $faceId;
    }
}
?>
