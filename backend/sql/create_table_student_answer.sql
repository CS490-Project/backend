CREATE TABLE IF NOT EXISTS  `cs490_student_answers`
(
    id INT AUTO_INCREMENT UNIQUE,
    answer TEXT,
    student_id VARCHAR(30),
    question_id INT,
    exam_id INT,
    comment VARCHAR(200) DEFAULT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES cs490_users(id)
    ON DELETE CASCADE
    FOREIGN KEY (question_id) REFERENCES cs490_questions(id)
    ON DELETE SET NULL
    FOREIGN KEY (exam_id) REFERENCES cs490_exams(id)
    ON DELETE CASCADE
);