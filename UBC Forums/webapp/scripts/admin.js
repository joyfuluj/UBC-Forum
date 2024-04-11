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
            } 
            else 
            {
                console.log("Post not deleted");
            }
            location.reload();
        });
    } 
    else 
    {
        console.log("Post deletion cancelled");
    }
}
