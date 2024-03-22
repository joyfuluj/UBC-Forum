CREATE DATABASE Forums
USE Forums

CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(25),
    email VARCHAR(50),
    firstName VARCHAR(25),
    lastName VARCHAR(25),
    signUpDate DATETIME
);

CREATE TABLE community(
    communityID INT AUTO_INCREMENT PRIMARY KEY,
    communityName VARCHAR(20) UNIQUE,
    communityDesc VARCHAR(200),
    ownerId INT,
    FOREIGN KEY (ownerId) REFERENCES users(userId)
);

//A trigger that makes the oldest moderator the new owner if the owner leaves the community
CREATE TRIGGER newOwner
AFTER DELETE ON users
FOR EACH ROW
BEGIN
    UPDATE community
    SET ownerId = (SELECT userId FROM memberOf WHERE communityID = communityID AND type = 'moderator' ORDER BY joinDate ASC LIMIT 1)
    WHERE ownerId = OLD.userId;
END

CREATE TABLE memberOf(
    communityID INT,
    userId INT,
    type ENUM('member', 'moderator'),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityID) REFERENCES community(communityID)
);

CREATE TABLE posts (
    postId INT AUTO_INCREMENT,
    postDesc VARCHAR(200),
    communityID INT,
    userId INT,
    promos INT,
    postTime DATETIME,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityID) REFERENCES community(communityID),
    PRIMARY KEY (postId, communityID)
);

CREATE TABLE comments(
    commentId INT AUTO_INCREMENT,
    postId INT,
    commentContent VARCHAR(900),
    commentTime DATETIME,
    promos INT,
    userId INT,
    FOREIGN KEY (postId) REFERENCES posts(postId)
    FOREIGN KEY (userId) REFERENCES users(userId)
    PRIMARY KEY (postId, commentId)
);
