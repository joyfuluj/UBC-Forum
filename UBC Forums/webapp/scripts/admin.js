function deleteUser(userId){
    fetch('../scripts/deleteUser.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `userId=${userId}`
        
    }).then(response => {
        if (response.ok) {
            console.log("User deleted");
        } else {
            console.log("User not deleted");
        }
        location.reload();

    });

}
function deletePost(postId, communityId){
    fetch('../scripts/deletePost.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `postId=${postId}&communityId=${communityId}`
        
    }).then(response => {
        if (response.ok) {
            console.log("Post deleted");
        } else {
            console.log("Post not deleted");
        }
        location.reload();
    });

}