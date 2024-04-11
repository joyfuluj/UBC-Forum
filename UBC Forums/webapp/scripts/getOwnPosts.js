let posts = [];
let pageNum = 0;
let morePosts = true; 

async function loadPosts(userId) 
{
    await requestPosts(userId).then(() =>
    {
        addPosts()
    });
}

async function requestPosts(userId) 
{
    let params = new URLSearchParams(window.location.search);
    let community = params.get('community');
    let search = params.get('search');
    let url = `../pages/postData.php?userId=${encodeURIComponent(userId)}&pageNum=${encodeURIComponent(pageNum)}`;
    
    if (userId) 
    {
        url += `&userId=${encodeURIComponent(userId)}`;
    } else 
    {
        if (community != null) 
        {
            url += `&community=${encodeURIComponent(community)}`;
        }
        if (search != null) {
            url += `&search=${encodeURIComponent(search)}`;
        }
    }

    const response = await fetch(url);
    
    if (response.ok) 
    {
        posts = await response.json();
        pageNum += 1;
    } 
    else 
    {
        console.error('HTTP error', response.status);
    }
}

async function getTextPosts(text) 
{
    const postText = await fetch(text);
    if (!postText.ok) 
    {
        console.log("error");
    } 
    else 
    {
        let result = await postText.text();
        return result;
    }
}

async function addPosts() 
{
    let feed = $("#posts");
    if (posts.length > 0 && morePosts == true) 
    {
        posts.forEach(async post => 
        {
            let username = await fetch(`../pages/getUsername.php?userId=${post.userId}`);
            username = await username.json();
            username = username.username;
            let postContent;
            if (post.postType == "txt") 
            {
                let text = await getTextPosts(`../posts/${post.postId}-${post.communityId}.${post.postType}`);
                postContent = $(`
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
                        
                        </div>
                    </div>`
                );
            } 
            else 
            {
                postContent = $(`
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

                        </div>
                    </div>`
                );
            }
            feed.append(postContent);
        });
    } 
    else if (morePosts == true) 
    {
        feed.append(`
            <h3>No more posts!</h3>
        `);
        morePosts = false;
    }
}

function handlePromo(postId, communityId) 
{
    promote(postId, communityId);
    console.log(`Promo clicked for post ${postId} in community ${communityId}`);
}

window.onload = function() 
{
    loadPosts(userId); 

    let feed = $("#posts");
    feed.scroll(function() 
    {
        if ($(feed).scrollTop() + $(feed).height() > $(feed).prop('scrollHeight') - 100) {
            loadPosts(userId); 
        }
    });
};

