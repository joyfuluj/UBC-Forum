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
    let filter = params.get('filter');
    let url = `../pages/ownPostData.php?userId=${encodeURIComponent(userId)}&pageNum=${encodeURIComponent(pageNum)}`;
    
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

function deleteUser(userId) 
{
    if (window.confirm("Are you sure you want to delete this user?")) 
    {
        fetch('../scripts/deleteUser.php', 
        {
            method: 'POST',
            headers: 
            {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `userId=${userId}`
            
        }).then(response => 
            {
            if (response.ok) 
            {
                console.log("User deleted");
            } 
            else 
            {
                console.log("User not deleted");
            }
            location.reload();
        });
    } 
    else 
    {
        console.log("User deletion cancelled");
    }
}

function deletePost(postId, communityId)
{
    // Show confirmation dialog
    if (window.confirm("Are you sure you want to delete this post?")) 
    {
        fetch('../scripts/deletePost.php', 
        {
            method: 'POST',
            headers: 
            {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `postId=${postId}&communityId=${communityId}`
            
        }).then(response => 
            {
            if (response.ok) 
            {
                console.log("Post deleted");
            } else 
            {
                console.log("Post not deleted");
            }
            location.reload();
        });
    } else {
        // If the user clicks "Cancel", log a message or perform some other actions
        console.log("Post deletion cancelled");
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
                    <div id='post-${post.postId}-${post.communityId}' class='textPost' style='max-width: 600px'>
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
                            <button class = 'deleteButton' onClick = 'deletePost(${post.postId}, ${post.communityId})'>Delete Post</button>
                            <button class = 'commentButton' onClick = 'handleLoadComments(${post.postId}, ${post.communityId})'>Comments</button>
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
                            <button class = 'deleteButton' onClick = 'deletePost(${post.postId}, ${post.communityId})'>Delete Post</button>
                            <button class = 'commentButton' onClick = 'handleLoadComments(${post.postId}, ${post.communityId})'>Comments</button>
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

window.onload = async function() 
{
    // Load posts
    loadPosts(userId); 

    // Preload comments for each post
    $(".commentButton").each(async function() {
        let postId = $(this).data('post-id');
        let communityId = $(this).data('community-id');
        await requestComments(postId, communityId);
    });

    let feed = $("#posts");
    feed.scroll(function() 
    {
        if ($(feed).scrollTop() + $(feed).height() > $(feed).prop('scrollHeight') - 100) {
            loadPosts(userId); 
        }
    });
};


