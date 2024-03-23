<<<<<<< Updated upstream
CREATE DATABASE Forums

USE Forums

=======
CREATE DATABASE Forums;
USE Forums;
>>>>>>> Stashed changes
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




CREATE TABLE posts (
    postId INT AUTO_INCREMENT,
    postDesc VARCHAR(200),
    communityID INT,
    userId INT,
    promos INT,
<<<<<<< Updated upstream
    postTime DATETIME
    FOREIGN KEY (userId) REFERENCES users(userId).
    FOREIGN KEY (communityID) REFERENCES community(communityID)
=======
    postType VARCHAR(10), 
    postTime DATETIME,
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityID) REFERENCES community(communityID),
>>>>>>> Stashed changes
    PRIMARY KEY (postId, communityID)
)

CREATE TABLE comments(
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    postId INT,
    commentContent VARCHAR(900),
    commentTime DATETIME,
    promos INT,
    userId INT,
    FOREIGN KEY (postId) REFERENCES posts(postId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    UNIQUE (postId, commentId)
);