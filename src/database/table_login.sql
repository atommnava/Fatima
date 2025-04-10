CREATE TABLE users(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    CONSTRAINT email_unique UNIQUE(email),
    password VARCHAR(255),
    role ENUM('user','admin')
);