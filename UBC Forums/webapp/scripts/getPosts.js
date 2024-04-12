let posts = [];
let pageNum = 0;
let morePosts = true; 
let postsAdded = false;
async function getSessionData() 
{
    let response = await fetch('../pages/getSession.php');
    let data = await response.json();
    return data;
}


async function loadSearch(communityId, userId){
    await requestSearch().then(() =>{
        addPosts()
    });
}  
async function loadPosts(){
    await requestPosts().then(() =>{
        addPosts()
    });
}
async function requestPosts() {
    //await returnReferenceError: handleLoadComments is not defined
    let params = new URLSearchParams(window.location.search);
    let community = params.get('community');
    let search = params.get('search');
    let filter = params.get('filter');
    if(community != null && search != null){
        const response = await fetch(`../pages/postData.php?community=${encodeURIComponent(community)}&search=${encodeURIComponent(search)}&pageNum=${encodeURIComponent(pageNum)}&filter=${encodeURIComponent(filter)}`);  
        if (response.ok) {
            posts = await response.json();
            pageNum +=1;
        } else {
            console.error('HTTP error', response.status);
        }
    }
    else if(community != null){
        const response = await fetch(`../pages/postData.php?community=${encodeURIComponent(community)}&pageNum=${encodeURIComponent(pageNum)}&filter=${encodeURIComponent(filter)}`);
        if (response.ok) {
            posts = await response.json();
            pageNum +=1;
        } else {
            console.error('HTTP error', response.status);
        }
    }else if(search != null){
        const response = await fetch(`../pages/postData.php?search=${encodeURIComponent(search)}&pageNum=${encodeURIComponent(pageNum)}&filter=${encodeURIComponent(filter)}`);
        if (response.ok) {
            posts = await response.json();
            pageNum +=1;
        } else {
            console.error('HTTP error', response.status);
        }

    }else{
        const response = await fetch(`../pages/postData.php?pageNum=${encodeURIComponent(pageNum)}&filter=${encodeURIComponent(filter)}`);;
        if (response.ok) {
            posts = await response.json();
            pageNum +=1;
        } else {
            console.error('HTTP error', response.status);
        }
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

async function userHasPromoted(postId, communityId, userId)
{
    let response = await fetch(`../scripts/getPromoted.php?postId=${postId}&communityId=${communityId}&userId=${userId}`);
    if(response.ok)
    {
        let text = await response.text();
        return text == '1';
    }
    else
    {
        console.error('Fetch failed');
        return false;
    }
}

async function addPosts(){
    let feed = $("#posts");
    if(posts.length > 0 && morePosts == true){
        postsAdded = true;
        for (const post of posts) {
            let usernameResponse = await fetch(`../pages/getUsername.php?userId=${post.userId}`);
            let username = await usernameResponse.json();
            username = username.username;

            let sessionData = await getSessionData();
            let session_userId = sessionData.user_id;

            let postContent;
            if(post.postType == "txt"){
                let text = await getTextPosts(`../posts/${post.postId}-${post.communityId}.${post.postType}`);
                postContent = 
                $(`
                <div id='post-${post.postId}-${post.communityId}' class='textPost'>
                    <div class='postHeader'>
                        <h3>${post.postTitle}</h3>
                        <div class='postDetails'>
                            <h4>${username}</h4>
                            <h5>${post.postTime}</h5>
                        </div>
                    </div>
                    <div class='postContent'>
                        <p>${text}</p>
                    </div>
                    <div class='postOptions'>
                        <button data-promo-button class=${await userHasPromoted(post.postId, post.communityId, session_userId) ? `'promo-promoted'` : `'promo'`} onClick='handlePromo(${post.postId}, ${post.communityId})'>^</button>
                        <p class='numPromo' id='promo-${post.postId}-${post.communityId}'>Promos: ${post.promos}</p>
                        <button class='commentButton' onClick='handleLoadComments(${post.postId}, ${post.communityId})'>Comments</button>
                    </div>
                </div>`
                );
            
            }
            else{
                postContent = 
                $(`
                    <div id='post-${post.postId}-${post.communityId}' class='post'>
                        <div class='postHeader'>
                            <h3>${post.postTitle}</h3>
                            <div class='postDetails'>
                                <h4>${username}</h4>
                                <h5>${post.postTime}</h5>
                            </div>
                        </div>
                        <div class='postContent'>
                            <a class='blank' href='../posts/${post.postId}-${post.communityId}.${post.postType}'>
                                <img src="../posts/${post.postId}-${post.communityId}.${post.postType}">
                            </a>
                        </div>
                        <div class='postOptions'>
                            <button data-promo-button class=${await userHasPromoted(post.postId, post.communityId, session_userId) ? `'promo-promoted'` : `'promo'`} onClick='handlePromo(${post.postId}, ${post.communityId})'>^</button>
                            <p class='numPromo' id='promo-${post.postId}-${post.communityId}'>Promos: ${post.promos}</p>
                            <button class='commentButton' onClick='handleLoadComments(${post.postId}, ${post.communityId})'>Comments</button>
                        </div>
                    </div>`
                );
            }
            feed.append(postContent);
        }
    } else if (morePosts == true) {
        if(!postsAdded){
            feed.append(`
                <h3>No Results found!</h3>
            `);
        }else{
            feed.append(`
            <h3>No more posts!</h3>
            `);
        }
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
function getTestPosts()
{
    let post = {
        postId: 1,
        communityId: 1,
        postTitle: "John's first post",
        postTime: "2024-04-03 12:23:13",
        userId: 1,
        postType: "jpg",
        promos: 0,
    };
    posts.push(post);
    post = {
        postId: 2,
        communityId: 2,
        postTitle: "John's second post",
        postTime: "2024-04-04 10:44:03",
        userId: 1,
        postType: "png",
        promos: 0,
    };
    posts.push(post);
    post = {
        postId: 3,
        communityId: 3,
        postTitle: "Jane's first post",
        postTime: "2024-04-06 02:51:58",
        userId: 2,
        postType: "jpg",
        promos: 0,
    };
    posts.push(post);
    post = {
        postId: 4,
        communityId: 4,
        postTitle: "Jane's second post",
        postTime: "2024-04-07 01:17:20",
        userId: 2,
        postType: "png",
        promos: 0,
    };
    posts.push(post);
    post = {
        postId: 5,
        communityId: 5,
        postTitle: "John's third post",
        postTime: "2024-04-09 07:21:28",
        userId: 1,
        postType: "txt",
        promos: 0,
    };
    posts.push(post);
    
}

function handlePromo(postId, communityId) 
{
    // Handle promo logic here
    promote(postId, communityId);
    console.log(`Promo clicked for post ${postId} in community ${communityId}`);

    // Toggle the background color of the button depending on currrent state
    let promoButton = $(`#post-${postId}-${communityId} button[data-promo-button]`);
    {
        if (promoButton.hasClass('promo')) 
        {
            promoButton.removeClass('promo').addClass('promo-promoted');
        } 
        else if (promoButton.hasClass('promo-promoted')) 
        {
            promoButton.removeClass('promo-promoted').addClass('promo');
        }
    }
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