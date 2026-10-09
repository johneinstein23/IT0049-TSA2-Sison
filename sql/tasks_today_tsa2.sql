CREATE DATABASE IF NOT EXISTS tasks_today_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE tasks_today_db;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    task_date DATE NOT NULL,
    created_at DATETIME NOT NULL,
    is_archived TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL,
    password VARCHAR(255) NULL
);

INSERT INTO tasks (title, status, task_date, created_at, is_archived) VALUES
('Review today’s sales summary', 'pending', CURDATE(), NOW(), 0),
('Confirm the morning inventory count', 'in_progress', CURDATE(), NOW(), 0),
('Send the daily team update', 'completed', CURDATE(), NOW(), 0),
('Check the delivery schedule', 'pending', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW(), 0),
('Organize supplier receipts', 'completed', DATE_SUB(CURDATE(), INTERVAL 1 DAY), NOW(), 0),
('Prepare the weekly report', 'pending', DATE_SUB(CURDATE(), INTERVAL 2 DAY), NOW(), 0),
('Update the product checklist', 'in_progress', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW(), 0),
('Plan the next stock review', 'pending', DATE_ADD(CURDATE(), INTERVAL 1 DAY), NOW(), 0);

-- Demo password: TasksDemo2026! (bcrypt hash; login uses password_verify)
INSERT INTO users (username, full_name, email, created_at, password) VALUES
('johneinstein', 'John Einstein Sison', 'john.einstein@example.test', NOW(), '$2y$12$MJKpLacinNEA/EM.B3pyw.OuJ/HodbH1AM645whPz5SHidoiuUop.');
