CREATE DATABASE Forums;
USE Forums;

CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(25),
    email VARCHAR(50),
    firstName VARCHAR(25),
    lastName VARCHAR(25),
    signUpDate DATETIME
);
);

CREATE TABLE community (
    communityID INT AUTO_INCREMENT PRIMARY KEY,
    communityName VARCHAR(20) UNIQUE,
    communityDesc VARCHAR(200),
    ownerId INT NOT NULL,
    FOREIGN KEY (ownerId) REFERENCES users(userId)
);
);

DELIMITER //
CREATE TRIGGER newOwner
AFTER DELETE ON users
FOR EACH ROW
BEGIN
    UPDATE community
    SET ownerId = (
        SELECT userId
        FROM memberOf
        WHERE communityID = communityID AND type = 'moderator'
        ORDER BY joinDate ASC
        LIMIT 1
    )
    WHERE ownerId = OLD.userId;
END//
DELIMITER ;

CREATE TABLE memberOf (
    communityID INT,
    userId INT,
    type ENUM('member', 'moderator'),
    joinDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (communityID, userId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityID) REFERENCES community(communityID)
);
);

CREATE TABLE posts (
    postId INT AUTO_INCREMENT,
    postTitle VARCHAR(200),
    communityId INT,
    userId INT,
    promos INT,
    postType VARCHAR(10), 
    postTime DATETIME
    FOREIGN KEY (userId) REFERENCES users(userId).
    FOREIGN KEY (communityID) REFERENCES community(communityID)
);

CREATE TABLE comments (
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    postId INT,
    commentContent VARCHAR(900),
    commentTime DATETIME,
    promos INT,
    userId INT,
    FOREIGN KEY (postId) REFERENCES posts(postId),
    FOREIGN KEY (userId) REFERENCES users(userId)
);

INSERT INTO `community` (`communityID`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'all', NULL, NULL);
INSERT INTO `community` (`communityID`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'travel', NULL, NULL);
INSERT INTO `community` (`communityID`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'game', NULL, NULL);INSERT INTO `community` (`communityID`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'al', NULL, NULL);
INSERT INTO `community` (`communityID`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'school', NULL, NULL);
INSERT INTO `community` (`communityID`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'sports', NULL, NULL);


INSERT INTO `users` (`userId`, `username`, `password`, `email`, `firstName`, `lastName`, `signUpDate`) VALUES (NULL, 'bob328', 'bobob', 'bob@gmail.com', 'Bob', 'BB', NOW());