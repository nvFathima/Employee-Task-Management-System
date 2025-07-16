CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'employee') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    assigned_to INT,
    due_date date,
    status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message TEXT NOT NULL,
    recipient INT NOT NULL,
    type VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    is_read BOOLEAN DEFAULT FALSE
);

INSERT INTO users (full_name, username, password, role)
VALUES (
  'Admin User',
  'admin',
  '$argon2id$v=19$m=65536,t=4,p=1$NS9iNzBNcmYuWlNRMWlrOA$D1poDXuJ1gtA54NPIaB5nD6Q6OPO8tQ587lnajFa6EA', -- admin123
  'admin'
);

INSERT INTO users (full_name, username, password, role)
VALUES (
  'Rose',
  'rose',
  '$argon2id$v=19$m=65536,t=4,p=1$b1kuMlA3MTZEdmR0Ui93cA$PTT+PlUaQ0H9DVqhZNhwfBcNVOXjCVGPJjmp8ZbUhpA', -- rose123
  'employee'
);
