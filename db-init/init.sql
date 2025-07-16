-- Create ENUM types first (PostgreSQL requires explicit type creation)
CREATE TYPE user_role AS ENUM ('admin', 'employee');
CREATE TYPE task_status AS ENUM ('pending', 'in_progress', 'completed');

-- Users table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    full_name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role user_role NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tasks table
CREATE TABLE tasks (
    id SERIAL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    assigned_to INTEGER,
    due_date DATE,
    status task_status DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES users(id)
);

-- Notifications table
CREATE TABLE notifications (
    id SERIAL PRIMARY KEY,
    message TEXT NOT NULL,
    recipient INTEGER NOT NULL,
    type VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    is_read BOOLEAN DEFAULT FALSE
);

-- Insert sample data
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