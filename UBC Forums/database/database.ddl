CREATE DATABASE IF NOT EXISTS db_81265373;
USE db_81265373;


CREATE TABLE IF NOT EXISTS users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    privilege ENUM('1', '2'),
    username VARCHAR(30),
    password VARCHAR(60),
    email VARCHAR(50),
    firstName VARCHAR(25),
    lastName VARCHAR(25),
    signUpDate DATETIME
);


CREATE TABLE IF NOT EXISTS community (
    communityId INT AUTO_INCREMENT PRIMARY KEY,
    communityName VARCHAR(20) UNIQUE,
    communityDesc VARCHAR(200),
    ownerId INT NOT NULL,
    FOREIGN KEY (ownerId) REFERENCES users(userId)
);


CREATE TABLE IF NOT EXISTS memberOf (
    communityId INT,
    userId INT,
    type ENUM('member', 'moderator'),
    joinDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (communityId, userId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityId) REFERENCES community(communityId)
);

CREATE TABLE IF NOT EXISTS posts (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    postTitle VARCHAR(200),
    communityId INT,
    userId INT,
    promos INT,
    postType VARCHAR(10), 
    postTime DATETIME,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityId) REFERENCES community(communityId),
    UNIQUE(postId, communityId)
);


CREATE TABLE IF NOT EXISTS comments(
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    postId INT,
    communityId INT,
    commentContent VARCHAR(900),
    commentTime DATETIME,
    promos INT,
    userId INT,
    FOREIGN KEY (postId) REFERENCES posts(postId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityId) REFERENCES community(communityId),
    UNIQUE (postId, communityId, commentId)
);

/*
DELIMITER //
/*
CREATE TRIGGER newOwner
AFTER DELETE ON users
FOR EACH ROW
BEGIN
    UPDATE community
    SET ownerId = (
        SELECT userId
        FROM memberOf
        WHERE communityId = communityId AND type = 'moderator'
        ORDER BY joinDate ASC
        LIMIT 1
    )
    WHERE ownerId = OLD.userId;
END//
*/
DELIMITER ;

DELIMITER //
/*
CREATE TRIGGER addOwnerAsModerator
AFTER INSERT ON community
FOR EACH ROW
BEGIN
    INSERT INTO memberOf (communityId, userId, type, joinDate)
    VALUES (NEW.communityId, NEW.ownerId, 'moderator', NOW);
END //
*/
DELIMITER ;

INSERT INTO `users` (`userId`, `privilege`, `username`, `password`, `email`, `firstName`, `lastName`, `signUpDate`) VALUES (NULL, '1', 'jdoe101', 'johndoepw', 'john@gmail.com', 'John', 'Doe', NOW());
INSERT INTO `users` (`userId`, `privilege`, `username`, `password`, `email`, `firstName`, `lastName`, `signUpDate`) VALUES (NULL, '2', 'jdoe102', 'janedoepw', 'jane@gmail.com', 'Jane', 'Doe', NOW());

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Travel', NULL,1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Game', NULL,1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Nature', NULL, 1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'School', NULL,1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Sports', NULL,1);

INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "Cool post", 1, 1,0, "txt", NOW());
INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "Cool post", 1, 1,0, "jpg", NOW());
INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "Cool post", 1, 1,0, "png", NOW());
