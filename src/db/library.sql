CREATE TABLE book(
	id INT PRIMARY KEY AUTO_INCREMENT,
    isbn VARCHAR(13) NOT NULL,
   	title VARCHAR(200) NOT NULL,
    author VARCHAR(150) NOT NULL,
    overview VARCHAR(1500),
    picture BLOB,
    read_count INT DEFAULT 1,
    UNIQUE (isbn)
);

INSERT INTO book (isbn, title, author, overview) VALUES 
('2476544100547', 'Harry potter', 'J K Rowling', 'Le livre le plus venfu au monde'),
('2476544100548', 'One piece', 'E. Oda', 'Le manga le plus célèbre au monde'); 