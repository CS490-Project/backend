CREATE TABLE IF NOT EXISTS  `cs490_exam_questions`
(
    id INT AUTO_INCREMENT UNIQUE,
    value DECIMAL(5,2),
    question_id INT,
    exam_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (question_id) REFERENCES cs490_questions(id) ON DELETE CASCADE,
    FOREIGN KEY (exam_id) REFERENCES cs490_exams(id) ON DELETE CASCADE
);