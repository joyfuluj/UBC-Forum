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
    profilePic VARCHAR(50),
    signUpDate DATETIME
);


CREATE TABLE IF NOT EXISTS community (
    communityId INT AUTO_INCREMENT PRIMARY KEY,
    communityName VARCHAR(20) UNIQUE,
    communityDesc VARCHAR(200),
    ownerId INT NOT NULL,
    FOREIGN KEY (ownerId) REFERENCES users(userId) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS memberOf (
    communityId INT,
    userId INT,
    type ENUM('member', 'moderator'),
    joinDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (communityId, userId),
    FOREIGN KEY (userId) REFERENCES users(userId),
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS posts (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    postTitle VARCHAR(200),
    communityId INT,
    userId INT,
    promos INT,
    postType VARCHAR(10), 
    postTime DATETIME,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE,
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
    FOREIGN KEY (postId) REFERENCES posts(postId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE,
    UNIQUE (postId, communityId, commentId)
);
CREATE TABLE IF NOT EXISTS commentLike (
    commentId INT,
    postId INT, 
    communityId INT,
    userId INT,
    FOREIGN KEY (commentId) REFERENCES comments(commentId) ON DELETE CASCADE,
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE,
    FOREIGN KEY (postId) REFERENCES posts(postId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
    PRIMARY KEY (commentId, postId, communityId, userId)
);
CREATE TABLE IF NOT EXISTS postLike(
    postId INT,
    communityId INT,
    userId INT,
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE,
    FOREIGN KEY (postId) REFERENCES posts(postId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
    PRIMARY KEY (postId, communityId, userId)
);

CREATE TABLE IF NOT EXISTS comments(
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    parentId INT,
    postId INT,
    communityId INT,
    commentContent VARCHAR(900),
    commentTime DATETIME,
    promos INT,
    userId INT,
    FOREIGN KEY (postId) REFERENCES posts(postId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE,
    UNIQUE (postId, communityId, commentId)
);
CREATE TABLE IF NOT EXISTS replies(
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    parentId INT,
    postId INT,
    communityId INT,
    commentContent VARCHAR(900),
    commentTime DATETIME,
    promos INT,
    userId INT,
    FOREIGN KEY (postId) REFERENCES posts(postId) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(userId) ON DELETE CASCADE,
    FOREIGN KEY (communityId) REFERENCES community(communityId) ON DELETE CASCADE,
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

INSERT INTO `users` (`userId`, `privilege`, `username`, `password`, `email`, `firstName`, `lastName`, `profilePic`, `signUpDate`) VALUES (NULL, '1', 'jdoe101', '$2y$10$/5gnl1PQBHjTf5lDXxmEIe1dx0FCqwTzOXfVQBo.PTuW265hXqqTO', 'john@gmail.com', 'John', 'Doe', 'default_account.jpg', NOW());
INSERT INTO `users` (`userId`, `privilege`, `username`, `password`, `email`, `firstName`, `lastName`, `profilePic`, `signUpDate`) VALUES (NULL, '2', 'jdoe102', '$2y$10$liNLLd9SPfHnPrhHy7HQxO9LEMDfqBcwmpa2nyr3cUvGGK9apwaMa', 'jane@gmail.com', 'Jane', 'Doe', 'default_account.jpg', NOW());

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Travel', NULL,1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Game', NULL,1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Nature', NULL, 1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'School', NULL,1);
INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`) VALUES (NULL, 'Sports', NULL,1);

INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "John's first post", 1, 1,0, "jpg", "2024-04-3 12:23:13");
INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "John's second post", 2, 1,0, "png", "2024-04-4 10:44:03");
INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "Jane's first post", 3, 2,0, "jpg", "2024-04-6 2:51:58");
INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "Jane's second post", 4, 2,0, "png", "2024-04-7 1:17:20");
INSERT INTO `posts` (`postId`, `postTitle`, `communityId`, `userId`, `promos`, `postType`, `postTime`) VALUES (NULL, "John's third post", 5, 1,0, "txt", "2024-04-9 7:21:28");

INSERT INTO `comments` (`commentId`, `postId`, `communityId`, `commentContent`, `commentTime`, `promos`, `userId`) VALUES (NULL, 1, 1, 'Great post!', NOW(), 0, 2);
INSERT INTO `comments` (`commentId`, `postId`, `communityId`, `commentContent`, `commentTime`, `promos`, `userId`) VALUES (NULL, 2, 2, 'Nice work!', NOW(), 0, 2);
INSERT INTO `comments` (`commentId`, `postId`, `communityId`, `commentContent`, `commentTime`, `promos`, `userId`) VALUES (NULL, 3, 3, 'Awesome!', NOW(), 0, 1);
INSERT INTO `comments` (`commentId`, `postId`, `communityId`, `commentContent`, `commentTime`, `promos`, `userId`) VALUES (NULL, 4, 4, 'Keep it up!', NOW(), 0, 1);
INSERT INTO `comments` (`commentId`, `postId`, `communityId`, `commentContent`, `commentTime`, `promos`, `userId`) VALUES (NULL, 5, 5, 'Excellent!', NOW(), 0, 2);
