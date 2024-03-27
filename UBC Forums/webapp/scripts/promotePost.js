export async function promote(postId, communityId){
    fetch(`../pages/promotePost.php?postId=${postId}&communityId=${communityId}`).then(response => {
        if(response.ok){
            if(response.text == 0){
                alert("You have already promoted this post");
            }
            else if(response.text == -1)
            {
                alert("please Login to promote a post")
            }
            else{
                let post = document.getElementById(`post-${postId}-${communityId}`);
                let promos = post.getElementsByClassName("promos")[0];
                promos.innerHTML = response.text;
            }
        }
    });
}