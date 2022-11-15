CREATE TABLE IF NOT EXISTS`cs490_graded_answers` (
  id INT AUTO_INCREMENT UNIQUE,
  pts_earned DECIMAL(5,2) DEFAULT 0.0,
  comment varchar(200) DEFAULT NULL,
  student_id varchar(20) DEFAULT NULL,
  exam_id int(11) DEFAULT NULL,
  question_id int(11) DEFAULT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (student_id) REFERENCES cs490_users(id) ON DELETE CASCADE,
  FOREIGN KEY (exam_id) REFERENCES cs490_exams(id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES cs490_questions(id) ON DELETE CASCADE
) 