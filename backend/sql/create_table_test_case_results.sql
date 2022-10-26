CREATE TABLE IF NOT EXISTS  `cs490_graded_answers`
(
    id INT AUTO_INCREMENT UNIQUE,
    expected VARCHAR(100),
    run VARCHAR(100),
    pts_possible INT ,
    pts_deducted INT DEFAULT 0,
    pts_override INT DEFAULT 0,
    comment varchar(200),
    student_id varchar(20),
    exam_id INT,
    question_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (student_id) REFERENCES cs490_users(id)
    ON DELETE CASCADE
    FOREIGN KEY (exam_id) REFERENCES cs490_exams(id)
    ON DELETE CASCADE
    FOREIGN KEY (question_id) REFERENCES cs490_questions(id)
    ON DELETE CASCADE
);