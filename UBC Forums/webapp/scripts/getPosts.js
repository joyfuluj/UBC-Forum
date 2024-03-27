

let posts = [];
let pageNum = 0;
let morePosts = true;   
async function loadPosts(){
    await requestPosts().then(() =>{
        addPosts()
    });
}
async function requestPosts() {
    //await returnReferenceError: handleLoadComments is not defined
    const response = await fetch(`../pages/postData.php?pageNum=${encodeURIComponent(pageNum)}`);;
    if (response.ok) {
        posts = await response.json();
        pageNum +=1;
    } else {
        console.error('HTTP error', response.status);
    }
}
async function getTextPosts(text){
    const postText = await fetch(text);
    if(!postText.ok){
        console.log("error");
    }
    else{
        let result = await postText.text();
        return result;
    }

}

async function addPosts(){
    let feed = $("#posts");
    if(posts.length > 0 && morePosts == true){
        posts.forEach(async post => {
            let username = await fetch(`../pages/getUsername.php?userId=${post.userId}`);
            username = await username.json();
            username = username.username;
            let postContent;
            if(post.postType == "txt"){
                //TODO: implement text reading from file
                let text = "Failed to load";
                text = await getTextPosts(`../posts/${post.postId}-${post.communityId}.${post.postType}`);
                postContent = 
                $(`
                <div id = 'post-${post.postId}-${post.communityId}' class = 'textPost'>
                    <div class = 'postHeader'>
                        <h3>${post.postTitle}</h3>
                        <div class = 'postDetails'>
                            <h4>${username}</h4>
                            <h5>${post.postTime}</h5>
                        </div>
                    </div>
                    <div class = 'postContent'>
                        <p>${text}</p>
                    </div>
                    <div class = 'postOptions'>
                        Promos: ${post.promos}
                        <button class = 'promo' onClick = 'handlePromo(${post.postId}, ${post.communityId})'>^</button>
                        <button class = 'commentButton' onClick = 'handleLoadComments(${post.postId}, ${post.communityId})'>Comments</button>

                    </div>
                </div>`
                );
            
            }
            else{
                
                postContent = 
                $(`
                    <div id = 'post-${post.postId}-${post.communityId}' class = 'post'>
                        <div class = 'postHeader'>
                            <h3>${post.postTitle}</h3>
                            <div class = 'postDetails'>
                                <h4>${username}</h4>
                                <h5>${post.postTime}</h5>
                            </div>
                        </div>
                        <div class = 'postContent'>
                        <a class = 'blank' href = '../posts/${post.postId}-${post.communityId}.${post.postType}'>
                            <img src="../posts/${post.postId}-${post.communityId}.${post.postType}">
                        </a>
                        </div>
                        <div class = 'postOptions'>
                            Promos: ${post.promos}
                            <button class = 'promo' onClick = 'handlePromo(${post.postId}, ${post.communityId})'>^</button>
                            <button class = 'commentButton' onClick = 'handleLoadComments(${post.postId}, ${post.communityId})'>Comments</button>

                        </div>
                    </div>`
                );

                

            }
            feed.append(postContent);
        });
    }else if(morePosts == true) {
        feed.append(`
            <h3>No more posts!</h3>
        `);
        morePosts = false;
    }
}
            /*
            postId INT AUTO_INCREMENT,
            postTitle VARCHAR(200),
            communityID INT,
            userId INT,
            promos INT,
            postTime DATETIME
            FOREIGN KEY (userId) REFERENCES users(userId).
            FOREIGN KEY (communityID) REFERENCES community(communityID)
            PRIMARY KEY (postId, communityID)
            */
function getTestPosts(){
    let post = {
        postId: 1,
        communityId: 1,
        postTitle: "Test Post",
        postTime: "2020-11-11",
        userId: "Test Author",
        postType: "txt",
        promos: 0,
    };
    posts.push(post);
    post = {
        postId: 3,
        communityId: 1,
        postTitle: "Test Post",
        postTime: "2020-11-11",
        userId: "Test Author",
        postType: "png",
        promos: 1244,
    };
    posts.push(post);
    post = {
        postId: 2,
        communityId: 1,
        postTitle: "Test Post",
        postTime: "2020-11-11",
        userId: "Test Author",
        postType: "jpg",
        promos: 124488880000,
    };
    posts.push(post);
    
}
function handlePromo(postId, communityId) {
    // Handle promo logic here
    promote(postId, communityId);
    console.log(`Promo clicked for post ${postId} in community ${communityId}`);
}
window.onload = function(){
    loadPosts();
    feed = $("#posts");
    feed.scroll(function() {
        
        if ( $(feed).scrollTop() + $(feed).height() > $(feed).prop('scrollHeight') - 100) {
            loadPosts();
        }
    });
    //getTestPosts();
    //addPosts();
};