CREATE TABLE `users` (
  `userId` int PRIMARY KEY AUTO_INCREMENT,
  `userName` varchar(255),
  `password` varchar(255),
  `email` varchar(255),
  `name` varchar(255),
  `school` varchar(255),
  `majorId` int,
  `graduateYear` int,
  `isInst` boolean
);

CREATE TABLE `classes` (
  `classId` int PRIMARY KEY AUTO_INCREMENT,
  `className` varchar(255),
  `majorId` int
);

CREATE TABLE `userClasses` (
  `userId` int,
  `classId` int
);

CREATE TABLE `majors` (
  `majorId` int PRIMARY KEY AUTO_INCREMENT,
  `majorName` varchar(255)
);

CREATE TABLE `posts` (
  `postId` int PRIMARY KEY AUTO_INCREMENT,
  `classId` int,
  `userId` int,
  `anon` boolean,
  `content` varchar(255),
  `title` varchar(255),
  `parentId` int,
  `initialDate` datetime,
  `lastEdited` datetime
);

ALTER TABLE `userClasses` ADD FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

ALTER TABLE `userClasses` ADD FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`);

ALTER TABLE `users` ADD FOREIGN KEY (`majorId`) REFERENCES `majors` (`majorId`);

ALTER TABLE `classes` ADD FOREIGN KEY (`majorId`) REFERENCES `majors` (`majorId`);

ALTER TABLE `posts` ADD FOREIGN KEY (`classId`) REFERENCES `classes` (`classId`);

ALTER TABLE `posts` ADD FOREIGN KEY (`userId`) REFERENCES `users` (`userId`);

ALTER TABLE `posts` ADD FOREIGN KEY (`parentId`) REFERENCES `posts` (`postId`);
