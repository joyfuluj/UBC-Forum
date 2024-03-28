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
    });

}