CREATE TABLE IF NOT EXISTS  `cs490_exams`
(
    id INT AUTO_INCREMENT,
    total INT,
    teacher_id VARCHAR(30),
    PRIMARY KEY (id),
    FOREIGN KEY (teacher_id) REFERENCES cs490_users(id)
);