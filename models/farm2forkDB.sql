-- Create the Role table
CREATE TABLE Role (
    role_id INT PRIMARY KEY,          
    role_name VARCHAR(50) NOT NULL    
);

INSERT INTO Role (role_id, role_name) VALUES
(0, 'admin'),
(1, 'agriculteur'),
(2, 'consomateur');

CREATE TABLE Utilisateur (
    user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    role_id INT NOT NULL,             
    ban_until TIMESTAMP NULL,
    nom_consomateur VARCHAR(30) NULL,
    prenom_consomateur VARCHAR(30) NULL,
    phone_number VARCHAR(15) NULL,    
    email VARCHAR(255) UNIQUE NOT NULL,      
    password VARCHAR(255) NOT NULL,   
    country VARCHAR(100) NULL,        
    city VARCHAR(100) NULL,           
    address TEXT NULL,                
    profile_pic VARCHAR(255) NULL,    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    genre VARCHAR(50) NULL,           
    farm_pics TEXT NULL,              
    farm_vids TEXT NULL,              
    farm_name VARCHAR(255) NULL,      
    farm_description TEXT NULL,  
    farm_owner_name VARCHAR(255) NULL;     
    CONSTRAINT fk_role FOREIGN KEY (role_id) REFERENCES Role(role_id) 
);

CREATE TABLE BanLog (
    ban_id INT PRIMARY KEY,              
    admin_id INT NOT NULL,                
    user_id INT NOT NULL,                 
    ban_start TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ban_end TIMESTAMP NOT NULL,           
    reason TEXT NULL,                     
    CONSTRAINT fk_admin FOREIGN KEY (admin_id) REFERENCES Utilisateur(user_id),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES Utilisateur(user_id)   
);

CREATE TABLE password_resets (
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires_at DATETIME NOT NULL,
    PRIMARY KEY (email)
);

INSERT INTO Utilisateur(email, password, role_id) VALUES ('admin@admin.admin', MD5('admin'), 0);
