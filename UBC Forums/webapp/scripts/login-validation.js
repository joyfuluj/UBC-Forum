// Create all variables for field values.
const form = document.getElementById("login-form");
const email = document.getElementById("email");
const password = document.getElementById("password");
const errorMsg = document.getElementById("error");

// Validate all field values and display error messages when necessary.
form.addEventListener("submit", (e) => 
{
    let messages = [];

    //if(email.value === "" || email.value === null){}

    if(password.value.length < 6) 
    {
        messages.push("Please enter a longer password.");
    } 
    else if(password.value.length > 20)
    {
        messages.push("Please enter shorter password.");
    }

    if(messages.length > 0) 
    {
        e.preventDefault();
        errorMsg.innerText = messages.join(", ");
    }
});
