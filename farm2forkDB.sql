CREATE TABLE Roles (
    role_id INTEGER PRIMARY KEY,
    role_name VARCHAR(20) UNIQUE NOT NULL
);


INSERT INTO Roles (role_id, role_name) VALUES 
(0, 'Admin'),
(1, 'Agriculteur'),
(2, 'Consomateur');

CREATE TABLE Utilisateurs (
    user_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    role_id INTEGER,
    phone_number VARCHAR(20),
    email VARCHAR(100) UNIQUE NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    country VARCHAR(50),
    city VARCHAR(50),
    addr VARCHAR(255),
    profile_pic VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES Roles(role_id) ON DELETE CASCADE
);
CREATE TABLE Agriculteurs (
    user_id INTEGER PRIMARY KEY,
    farm_name VARCHAR(100) NOT NULL,
    farm_owner_name VARCHAR(100),
    farm_pictures VARCHAR(255),
    farm_videos VARCHAR(255), 
    farm_description TEXT,
    farm_location VARCHAR(200),
    CONSTRAINT fk_user_agriculteur FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id) ON DELETE CASCADE
);

CREATE TABLE Consomateurs (
    user_id INTEGER PRIMARY KEY,
    genre VARCHAR(50),
    CONSTRAINT fk_user_consomateur FOREIGN KEY (user_id) REFERENCES Utilisateurs(user_id) ON DELETE CASCADE
);

