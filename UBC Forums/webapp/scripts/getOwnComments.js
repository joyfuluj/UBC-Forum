let comments = [];
let commentNum = 0;
let lastFetch = formatDate(new Date());
let newComments = []

async function getSessionData() 
{
    let response = await fetch('../pages/getSession.php');
    let data = await response.json();
    return data;
}

function formatDate(date) 
{
    let year = date.getFullYear();
    let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-indexed in JavaScript
    let day = date.getDate().toString().padStart(2, '0');
    let hours = date.getHours().toString().padStart(2, '0');
    let minutes = date.getMinutes().toString().padStart(2, '0');
    let seconds = date.getSeconds().toString().padStart(2, '0');

    return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
}
async function getNewComments(postId, communityId) {
    let url = `../pages/newCommentData.php?postId=${postId}&communityId=${communityId}&lastFetch=${lastFetch}`;
    const response = await fetch(url);
    if (response.ok) {
        let result = await response.json();
        if(result.length > 0){
            newComments.push(...result);
            addNewComments();
        }
        lastFetch = formatDate(new Date());
    } else {
        console.error('HTTP error', response.status);
    }
}
function addNewComments(){

    if(newComments.length > 0){
        let commentFeed = $("#sideMenuContent");

        newComments.forEach(async comment => {
            let username = await fetch(`../pages/getUsername.php?userId=${comment.userId}`);
            username = await username.json();
            username = username.username;
            let postContent;
            
            postContent = 
            $(`
            <div class='commentDetails'>
                <h1>${username}</h1>
                <h1>${comment.commentTime}</h1>
                <p>${comment.commentContent}</p>
            </div>`
            );
            
            commentFeed.append(postContent);
        });
        newComments = [];
    }
}

async function handleLoadComments(postId, communityId) 
{
    // Get the post's div
    let postDiv = $(`#post-${postId}-${communityId}`);
    
    // Create or get the comments div
    let commentsDiv = $(`#comments-${postId}-${communityId}`);
    
    // If comments are not loaded yet, fetch and add them
    if (!commentsDiv.length) {
        // Fetch and add new comments
        commentsDiv = $(`<div id='comments-${postId}-${communityId}' style='display:none'></div>`);
        const comments = await requestComments(postId, communityId);
        if (comments.length > 0) 
        {
            addComments(comments, commentsDiv);
        }
        else
        {
            let postContent;
            postContent = 
            $(`
            <div class='commentDetails' style='text-align: center; padding: 1em; margin-bottom: 1em;'>
                <h4>This post doesn't have any comments yet!</h4>
            </div>`
            );
            
            commentsDiv.append(postContent); // Append to the respective comments div
        }
        // Append the comments div to the post div
        postDiv.append(commentsDiv);
    }
    
    // Toggle the visibility of comments
    commentsDiv.toggle();
}


async function requestComments(postId, communityId) {
    let url = `../pages/commentData.php?postId=${postId}&communityId=${communityId}&pageNum=${commentNum}`;
    const response = await fetch(url);
    if (response.ok) {
        return await response.json();
    } else {
        console.error('HTTP error', response.status);
        return []; // Return empty array if there's an error
    }
}

function deleteComment(commentId, postId, communityId)
{
    // Show confirmation dialog
    if (window.confirm("Are you sure you want to delete this comment?")) 
    {
        fetch('../scripts/deleteComment.php', 
        {
            method: 'POST',
            headers: 
            {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `commentId=${commentId}&postId=${postId}&communityId=${communityId}`
            
        }).then(response => 
            {
            if (response.ok) 
            {
                console.log("Comment deleted");
            } else 
            {
                console.log("Comment not deleted");
            }
            location.reload();
        });
    } 
    else 
    {
        // If the user clicks "Cancel", log a message or perform some other actions
        console.log("Comment deletion cancelled");
    }
}

function addComments(comments, commentsDiv) 
{
    if (comments.length > 0) 
    {
        comments.forEach(async comment => 
        {
            let username = await fetch(`../pages/getUsername.php?userId=${comment.userId}`);
            username = await username.json();
            username = username.username;
    
            let sessionData = await getSessionData();
            let session_userId = sessionData.user_id;
            let session_privilege = sessionData.user_privilege;
            
            let postContent;
            postContent = 
            $(`
            <div class="commentHeader" style='display: flex; justify-content: space-between; align-items: center; background: #F7C5A3; padding: 1em; margin-top: 1em; margin-right: 1em; margin-bottom: 0; margin-left: 1em; border-top-left-radius: 1em; border-top-right-radius: 1em;'>
                <div class='commentDetails'>
                    <h4 style='margin: 0;'>${username}</h4>
                    <h4 style='margin: 0;'>${comment.commentTime}</h4>
                </div>
                ${session_userId == comment.userId || session_privilege == 2 ? `
                <div class='commentDelete'>
                    <button class = 'deleteButton' onClick = 'deleteComment(${comment.commentId}, ${comment.postId}, ${comment.communityId})'>Delete</button>
                </div>` : ''}
            </div>
        
            <div class='commentContent' style='background: #FCEADE; padding: 1em; margin-top: 0; margin-right: 1em; margin-bottom: 1em; margin-left: 1em; border-bottom-left-radius: 1em; border-bottom-right-radius: 1em;'>
                <p style='margin: 0;'>${comment.commentContent}</p>
            </div>`
            );
            
            commentsDiv.append(postContent); // Append to the respective comments div
        });
    } 
    else 
    {
        let postContent;
        postContent = 
        $(`
        <div class='commentDetails' style='text-align: center; padding: 1em; margin-bottom: 1em;'>
            <h4>This post doesn't have any comments yet!</h4>
        </div>`
        );
        
        commentsDiv.append(postContent); // Append to the respective comments div
    }
}

window.onload = function(){
    commentFeed = $("#sideMenuContent");
    commentFeed.scroll(function() {
        
        if ( $(commentFeed).scrollTop() + $(commentFeed).height() > $(commentFeed).prop('scrollHeight') - 100) {
            handleLoadComments();
        }
    });
    //getTestPosts();
    //addPosts();
};