let comments = [];
let commentNum = 0;
async function handleLoadComments(postId, communityId){
    commentNum=0;
    commentFeed = $("#sideMenuContent");
    let newComment = $("#sideOptions");
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
        addComments()
        commentNum +=1;
    } else {
        console.error('HTTP error', response.status);
    }
}

async function addComments(){
    let commentFeed = $("#sideMenuContent");
    let newComment = $("#sideOptions");
    if(comments.length > 0){
        comments.forEach(async comment => {
            let username = await fetch(`../pages/getUsername.php?userId=${comment.userId}`);
            username = await username.json();
            username = username.username;
            let postContent;
            
            postContent = 
            $(`
            <div id = 'comment-${comment.commentId}-${comment.postId}-${comment.communityId}' class = 'comment'>
                <div class = 'commentHeader'>
                    <div class = 'commentDetails'>
                        <h4>${username}</h4>
                        <h5>${comment.commentTime}</h5>
                    </div>
                </div>
                <div class = 'commentContent'>
                    <p>${comment.commentContent}</p>
                </div>
                <div class = 'commentOptions'>
                    Reply: <button id = '${comment.commentId}-${comment.postId}-${comment.communityId}' class = 'likeButton'></button>
                    <button 
                </div>
            </div>`
            );
            
            commentFeed.append(postContent);
        });
        let newForm = $(`
            <textarea type="text" id="commentInput" maxlength="900" name="commentInput" placeholder="New Comment..."></textarea>
            <button id='newComment' onClick = 'sendComment()'>🤌</button>
            `);
            newComment.append(newForm);

    }else{
        commentFeed.append(`
            <h3>Be the first to comment!</h3>
        `);
    }
}
function sendComment(){
    let content = $("#commentInput").val();
    if(content != ""){
        let postId = comments[0].postId;
        let communityId = comments[0].communityId;
        let url = 'postComment.php?postId=' + postId + '&communityId=' + communityId + '&commentContent=' + content; 
        fetch(url).then((response) => {
            if (response.ok) {
                handleLoadComments(postId, communityId);
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