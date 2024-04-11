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
    communityDesc VARCHAR(600),
    ownerId INT NOT NULL,
    dateCreated DATE DEFAULT '2000-01-01',
    FOREIGN KEY (ownerId) REFERENCES users(userId) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS memberOf (
    communityId INT,
    userId INT,
    type ENUM('member', 'moderator', 'admin'),
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
    pin INT,
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

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`, dateCreated) 
VALUES (NULL, 'Travel', 'Pack your bags and join our Travel community for an unforgettable journey around the globe! Whether you''re a seasoned traveler or an aspiring explorer, this forum is your passport to discovering new destinations, sharing travel tips, and connecting with fellow wanderlust souls. Embark on epic adventures, swap travel stories, and uncover hidden gems as we explore the beauty of our diverse world together.', 1, NOW());

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`, dateCreated) 
VALUES (NULL, 'Game', 'Dive into the exhilarating world of gaming with our vibrant Game community! From classic titles to the latest releases, this forum is your ultimate destination for all things gaming-related. Share your gaming experiences, discover new strategies, and connect with fellow gamers who share your passion for immersive adventures and competitive challenges. Get ready to level up your gaming journey!', 1, NOW());

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`, dateCreated) 
VALUES (NULL, 'Nature', 'Welcome to the Nature community, where the wonders of the natural world await! Step into the serene realm of forests, mountains, oceans, and beyond as we celebrate the breathtaking beauty and boundless diversity of Mother Nature. Share awe-inspiring photographs, discuss conservation efforts, and immerse yourself in discussions about wildlife, ecology, and sustainability. Let''s reconnect with the great outdoors and marvel at the magnificence of our planet.', 1, NOW());

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`, dateCreated) 
VALUES (NULL, 'School', 'Welcome to the School community! Whether you''re a student, educator, or someone passionate about learning, this forum is your hub for discussing educational experiences, sharing study tips, and engaging in lively debates on various academic topics. Join us in fostering a supportive environment where knowledge thrives and learning knows no bounds.', 1, NOW());

INSERT INTO `community` (`communityId`, `communityName`, `communityDesc`, `ownerId`, dateCreated) 
VALUES (NULL, 'Sports', 'Get ready to cheer on your favorite teams and athletes in our dynamic Sports community! Whether you''re a die-hard fan, an amateur athlete, or just love the thrill of competition, this forum is your arena for all things sports-related. From intense match analyses to friendly debates about the latest sporting events, join us as we celebrate the passion, athleticism, and camaraderie that define the world of sports. Game on!', 1, NOW());


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
