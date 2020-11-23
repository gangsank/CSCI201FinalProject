DROP DATABASE IF EXISTS SimpleDB;
CREATE DATABASE SimpleDB;
CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `PostID` int(11) NOT NULL,
  `Comment` varchar(2000) NOT NULL
);

CREATE TABLE `posts` (
  `PostID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` varchar(2000) NOT NULL
);

CREATE TABLE `users` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `CourseEnrolled` varchar(255) NOT NULL
); 

ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `PostID` (`PostID`);

ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`(250));

ALTER TABLE `posts`
  MODIFY `PostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `comments`
  ADD CONSTRAINT `PostID` FOREIGN KEY (`PostID`) REFERENCES `posts` (`PostID`);
COMMIT;

