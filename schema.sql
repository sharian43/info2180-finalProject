DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;

-- schema.sql
-- Create users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    role VARCHAR(50),
    created_at DATETIME
);

-- Create contacts table
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    email VARCHAR(255),
    telephone VARCHAR(20),
    company VARCHAR(255),
    type ENUM('sales lead', 'support'),
    assigned_to INT,
    created_by INT,
    created_at DATETIME,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create notes table
DROP TABLE IF EXISTS `notes`;
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_id INT,
    comment TEXT,
    created_by INT,
    created_at DATETIME
);

-- Insert a user with hashed password
INSERT INTO users (firstname, lastname, email, password, role, created_at) 
VALUES ('Admin', 'User', 'admin@project2.com', 'password123', 'admin', NOW());

GRANT ALL PRIVILEGES ON dolphin_crm.* TO 'Admin'@'localhost'IDENTIFIED BY 'password123';
FlUSH PRIVILEGES;