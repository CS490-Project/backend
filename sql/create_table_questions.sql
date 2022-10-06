CREATE TABLE IF NOT EXISTS  `cs490_questions`
(
    `id`          INT AUTO_INCREMENT,
    `description` TEXT,
    `difficulty`  INT DEFAULT 0,
    `category`    ENUM('variables', 'for loops', 'while loops', 'arrays', 'if statements'),
    `teacher_id`  VARCHAR(30),
    PRIMARY KEY (`id`),
    FOREIGN KEY (`teacher_id`) REFERENCES cs490_users(`ucid`)
);