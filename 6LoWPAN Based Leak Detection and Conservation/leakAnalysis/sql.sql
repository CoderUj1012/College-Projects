CREATE TABLE LEAKAGE
(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    pipe INT NOT NULL DEFAULT '1',
    leaktime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(30) NOT NULL,
    FOREIGN KEY(email) REFERENCES OWNER(email) ON DELETE CASCADE ON UPDATE CASCADE
);