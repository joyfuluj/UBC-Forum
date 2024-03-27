async function promote(postId, communityId){
    fetch(`../pages/promotePost.php?postId=${postId}&communityId=${communityId}`).then(response => {
        if(response.ok){
            response.text().then(text => {
                console.log(text);
                if(text == 1){
                    let promo = document.getElementById(`promo-${postId}-${communityId}`);
                    let newPromo = parseInt(promo.innerHTML.split(" ")[1]) + 1;
                    promo.innerHTML = "Promos: " + newPromo;
                }
                else if(text == 2){
                    let promo = document.getElementById(`promo-${postId}-${communityId}`);
                    let newPromo = parseInt(promo.innerHTML.split(" ")[1]) - 1;
                    promo.innerHTML = "Promos: " + newPromo;
                }
                else if(text == 3)
                {
                    alert("please Login to promote a post")
                }
                else{
                    alert("error");
                }
            });
            
        }
    });
}