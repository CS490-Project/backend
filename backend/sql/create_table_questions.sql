CREATE TABLE IF NOT EXISTS  `cs490_questions`
(
    id INT AUTO_INCREMENT UNIQUE,
    description TEXT,
    fname VARCHAR(20),
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'easy',
    constraints ENUM('for loop', 'while loop', 'recursion'),
    category ENUM('variables', 'conditionals', 'for loops', 'while loops', 'lists'),
    teacher_id VARCHAR(30),
    PRIMARY KEY (id),
    FOREIGN KEY (teacher_id) REFERENCES cs490_users(id) ON DELETE CASCADE
);