CREATE TABLE IF NOT EXISTS  `cs490_exams`
(
    id INT AUTO_INCREMENT,
    title VARCHAR(100) UNIQUE,
    total INT,
    teacher_id VARCHAR(30),
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (teacher_id) REFERENCES cs490_users(id)
);