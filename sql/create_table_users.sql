CREATE TABLE IF NOT EXISTS `cs490_users` 
(
  id VARCHAR(30) NOT NULL UNIQUE,
  role ENUM('student','teacher') NOT NULL DEFAULT 'student',
  password VARCHAR(60) NOT NULL,
  created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
); 
