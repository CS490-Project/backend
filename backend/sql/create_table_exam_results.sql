CREATE TABLE IF NOT EXISTS  `cs490_exam_results`
(
    id INT AUTO_INCREMENT UNIQUE,
    score INT DEFAULT NULL,
    student_id INT,
    exam_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES cs490_users(id)
    ON DELETE CASCADE
    FOREIGN KEY (exam_id) REFERENCES cs490_exams(id)
    ON DELETE CASCADE
);