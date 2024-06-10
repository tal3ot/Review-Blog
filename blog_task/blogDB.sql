

CREATE TABLE users_info (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_Num VARCHAR(30) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
    PRIMARY KEY (id)
    );
	
	
CREATE TABLE reviews (
id INT(11) NOT NULL AUTO_INCREMENT,
username VARCHAR(30) NOT NULL,
review TEXT NOT NULL,
created_at DATETIME NOT NULL DEFAULT CURRENT_TIME,
users_id INT(11),
PRIMARY KEY (id),
FOREIGN KEY (users_id) REFERENCES users_info (id) ON DELETE SET NULL
);