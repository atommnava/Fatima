CREATE DATABASE bookstore;
USE bookstore;

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    genre VARCHAR(100),
    price DECIMAL(10,2),
    stock INT DEFAULT 0,
    cover_image VARCHAR(255) -- URL de la imagen del libro
);

INSERT INTO books (title, author, genre, price, stock, cover_image) VALUES
('El Principito', 'Antoine de Saint-Exupéry', 'Ficción', 12.99, 10, 'public/covers/principito.png'),
('Cien Años de Soledad', 'Gabriel García Márquez', 'Realismo Mágico', 15.50, 5, 'public/covers/cien_anios.png'),
('1984', 'George Orwell', 'Distopía', 14.99, 8, 'public/covers/1984.png');


