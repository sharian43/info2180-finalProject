CREATE DATABASE schema;

-- schema.sql
-- Create users table
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
    updated_at DATETIME CURRENT_TIMESTAMP
);

-- Create notes table
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contact_id INT,
    comment TEXT,
    created_by INT,
    created_at DATETIME
);

-- Insert a user with hashed password
INSERT INTO users (firstname, lastname, email, password, role, created_at) 
VALUES ('Admin', 'User', 'admin@project2.com', '$2a$12$3WE1VhzjyFOY8/dWQghy2e/jr2eZpSjJi2D3rxgQ/fnSkUCSSr7Im', 'admin'. now());
