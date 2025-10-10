
DROP DATABASE IF EXISTS baseball_01;
CREATE DATABASE baseball_01;
USE baseball_01;


CREATE USER IF NOT EXISTS 'student1'@'localhost' IDENTIFIED BY 'pass';
GRANT ALL PRIVILEGES ON baseball_01.* TO 'student1'@'localhost';
FLUSH PRIVILEGES;


DROP TABLE IF EXISTS FavoriteMovies_8;


CREATE TABLE FavoriteMovies_8 (
  MovieID INT NOT NULL PRIMARY KEY,
  Title VARCHAR(50) NOT NULL,
  Genre VARCHAR(30),
  ReleaseYear INT,
  Rating DECIMAL(2,1),
  WatchDate DATE
);


INSERT INTO FavoriteMovies_8 VALUES
(1, 'The Matrix', 'Sci-Fi', 1999, 8.7, '2010-07-15'),
(2, 'Gladiator', 'Historical Drama', 2000, 8.5, '2012-03-21'),
(3, 'Spirited Away', 'Animation', 2001, 8.6, '2016-11-05'),
(4, 'Arrival', 'Sci-Fi', 2016, 7.9, '2017-08-12'),
(5, 'Dune', 'Adventure', 2021, 8.3, '2022-11-02');


SELECT * FROM FavoriteMovies_8;
