CREATE DATABASE stoktrack_db;
USE stoktrack_db;

-- Tabel Users
CREATE TABLE users (
  id_user INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'user') NOT NULL
);

-- Dummy akun
INSERT INTO users (username, password, role) VALUES
('admin', MD5('admin123'), 'admin'),
('user', MD5('user123'), 'user');

-- Tabel Kategori
CREATE TABLE kategori (
  id_kategori INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL
);

-- Tabel Produk
CREATE TABLE produk (
  id_produk INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  harga INT NOT NULL,
  id_kategori INT,
  FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) ON DELETE SET NULL
);
