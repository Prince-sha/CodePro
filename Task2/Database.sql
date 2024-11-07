CREATE DATABASE announcement_db;

USE announcement_db;

CREATE TABLE announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    announcement_date DATE NOT NULL,
    image VARCHAR(255) DEFAULT 'dummy_image.jpg',
    file VARCHAR(255) DEFAULT NULL
);
