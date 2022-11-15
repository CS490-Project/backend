CREATE TABLE IF NOT EXISTS`cs490_test_case_results` (
  id INt AUTO_INCREMENT UNIQUE,
  expected VARCHAR(100),
  run VARCHAR(100),
  pts_possible DECIMAL(5,2) DEFAULT NULL,
  pts_deducted DECIMAL(5,2) DEFAULT 0.00,
  pts_override DECIMAL(5,2) DEFAULT 0.00,
  student_id varchar(20) DEFAULT NULL,
  exam_id int(11) DEFAULT NULL,
  question_id int(11) DEFAULT NULL,
  test_case_id int(11) DEFAULT NULL,

  PRIMARY KEY (id),
  FOREIGN KEY (student_id) REFERENCES cs490_users(id) ON DELETE CASCADE,
  FOREIGN KEY (exam_id) REFERENCES cs490_exams(id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES cs490_questions(id) ON DELETE CASCADE,
  FOREIGN KEY (test_case_id) REFERENCES cs490_test_cases(id) ON DELETE CASCADE
) 