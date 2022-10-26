CREATE TABLE IF NOT EXISTS `cs490_test_cases`
(
    id INT AUTO_INCREMENT UNIQUE,
    test_in TEXT,
    test_out TEXT,
    question_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (question_id) REFERENCES cs490_questions(id)
    ON DELETE CASCADE
);