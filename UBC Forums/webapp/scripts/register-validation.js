// Create all variables for field values.
const form = document.getElementById("register-form");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password1 = document.getElementById("password1");
const password2 = document.getElementById("password2");
const errorMsg = document.getElementById("error");

// Validate all field values and display error messages when necessary.
form.addEventListener("submit", (e) => 
{
    let messages = [];

    if(username.value.length < 6) 
    {
        messages.push("Username must be longer than 6 characters.");
    } 
    else if(username.value.length > 16)
    {
        messages.push("Username must be shorter than 20 characters.");
    }

    //if (email.value){}

    if(password1.value.length < 6) 
    {
        messages.push("Password must be longer than 6 characters.");
    } 
    else if(password1.value.length > 16)
    {
        messages.push("Password must be shorter than 20 characters.");
    }
    if (password2.value !== password1.value) 
    {
        messages.push("Passwords do not match. Please try again.");
    }

    if (messages.length > 0) 
    {
        e.preventDefault();
        errorMsg.innerText = messages.join(", ");
    }
});
