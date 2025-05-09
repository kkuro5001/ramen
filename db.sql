CREATE TABLE login (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(50) NOT NULL,
    PASSWORD VARCHAR(255) NOT NULL,
    EMAIL VARCHAR(50) NOT NULL
);

--口コミ
CREATE TABLE ramen_reviews (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    STORE_NAME VARCHAR(100) NOT NULL,
    COMMENT TEXT NOT NULL,
    TASTE_ID INT NOT NULL,
    USER_ID INT,
     DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (USER_ID) REFERENCES login(ID),
    FOREIGN KEY (TASTE_ID) REFERENCES taste(ID)
);

--photoは画像データを直接保存する
--データが大きいので写真だけ別に保存する
CREATE TABLE ramen_photos (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    REVIEW_ID INT NOT NULL,
    PHOTO LONGBLOB NOT NULL,
    FOREIGN KEY (REVIEW_ID) REFERENCES ramen_reviews(ID) ON DELETE CASCADE
);

--味選択肢
CREATE TABLE taste (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NAME VARCHAR(50) NOT NULL
);

INSERT INTO taste (NAME) VALUES
('醤油'),
('味噌'),
('豚骨'),
('家系'),
('その他');