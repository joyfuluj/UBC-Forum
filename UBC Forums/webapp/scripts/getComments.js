let comments = [];
let commentNum = 0;
let lastFetch = formatDate(new Date());
let newComments = []

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

        newComments.forEach(async comment => {
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

async function addComments(postId, communityId){
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