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

function formatDate(date) {
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

        newComments.forEach(async comment =>
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
            <div id = 'comment-${comment.commentId}-${comment.postId}-${comment.communityId}' class = 'comment'>
                <div class = 'commentHeader'>
                    <div class = 'commentDetails'>
                        <h4>${username}</h4>
                        <h5>${comment.commentTime}</h5>
                    </div>
                    ${session_userId == comment.userId || session_privilege == 2 ? `<div class='commentDelete'>
                        <button class = 'deleteButton' onClick = 'deleteComment(${comment.commentId}, ${comment.postId}, ${comment.communityId})'>Delete</button>
                    </div>` : ''}
                </div>
                <div class = 'commentContent'>
                    <p>${comment.commentContent}</p>
                </div>
            </div>`
            );
            
            commentFeed.append(postContent);
        });
        newComments = [];
    }
}
function isMobileSite() {
    return window.innerWidth <= 800;
}

async function handleLoadComments(postId, communityId){
    commentNum=0;
    if (isMobileSite()) {
        $("#sideMenu").show();
    }
    setInterval(() => {
        getNewComments(postId, communityId);
    }, 10000);
    let newComment = $("#sideOptions");
    let commentFeed = $("#sideMenuContent");
    newComment.empty();
    commentFeed.empty();
    await requestComments(postId, communityId).then(() =>{
        if (comments.length <= 0) {
          return;
        }
        
    });
    //getTestComments();
}

async function requestComments(postId, communityId) {
    //await return
    let url = `../pages/commentData.php?postId=${postId}&communityId=${communityId}&pageNum=${commentNum}`;
    const response = await fetch(url);
    if (response.ok) {
        comments = await response.json();
        addComments(postId, communityId);
        commentNum +=1;
        
    } else {
        console.error('HTTP error', response.status);
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

async function addComments(postId, communityId){
    let commentFeed = $("#sideMenuContent");
    let newComment = $("#sideOptions");
    if(comments.length > 0){
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
            <div id = 'comment-${comment.commentId}-${comment.postId}-${comment.communityId}' class = 'comment'>
                <div class = 'commentHeader'>
                    <div class = 'commentDetails'>
                        <h4>${username}</h4>
                        <h5>${comment.commentTime}</h5>
                    </div>
                    ${session_userId == comment.userId || session_privilege == 2 ? `<div class='commentDelete'>
                        <button class = 'deleteButton' onClick = 'deleteComment(${comment.commentId}, ${comment.postId}, ${comment.communityId})'>Delete</button>
                    </div>` : ''}
                </div>
                <div class = 'commentContent'>
                    <p>${comment.commentContent}</p>
                </div>
            </div>`
            );
            
            commentFeed.append(postContent);
        });

    }else{
        commentFeed.append(`
            <h3>Be the first to comment!</h3>
        `);
        
    }
    let newForm = $(`
            <textarea type="text" id="commentInput" maxlength="900" name="commentInput" placeholder="New Comment..."></textarea>
            <button id='newComment' onClick = 'sendComment(${postId}, ${communityId})'>🤌</button>
            `);
            newComment.append(newForm);
}
function sendComment(postId, communityId){
    let content = $("#commentInput").val();
    if(content != ""){
        let url = 'postComment.php?postId=' + postId + '&communityId=' + communityId + '&commentContent=' + content; 
        fetch(url).then((response) => {
            if (response.ok) {
                response.text().then(text => {
                    if(text === '-2'){
                        alert("Please Login to comment");
                        return;
                    }else{
                        handleLoadComments(postId, communityId);
                    }
                });   
            }


        })
        .catch((error) => {
        console.error('Error:', error);
        });
    }
    
}
function getTestComments(){
    let comment = {
        postId: 1,
        communityId: 1,
        commentId: 1,
        commentTime: "2021-03-01 12:00:00",
        commentContent: "Test Comment",
        userId: 1,
        promos: 0,
    };
    comments.push(comment);
    addComments();
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