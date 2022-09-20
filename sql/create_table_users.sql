CREATE TABLE IF NOT EXISTS `User`(
    `userId` varchar(30) NOT NULL
    ,'role' ENUM('student', 'teacher')  DEFAULT 'student'
    ,`password` VARCHAR(60) NOT NULL
    ,`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
    ,PRIMARY KEY (`userId`)
	,UNIQUE (`userId`)
)
