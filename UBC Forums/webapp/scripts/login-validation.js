// Create all variables for field values.
const form = document.getElementById("login-form");
const username = document.getElementById("email");
const password = document.getElementById("password");
const usernameErrorMsg = document.getElementById("username-error");
const passwordErrorMsg = document.getElementById("password-error");

// Validate all field values and display error messages when necessary.
form.addEventListener("submit", (e) => 
{
    e.preventDefault(); // prevent form from submitting by default

    // Clear previous error messages
    usernameErrorMsg.innerText = "";
    passwordErrorMsg.innerText = "";

    // Username validation
    if(username.value == "" || username.value == null) 
    {
        usernameErrorMsg.innerText = "Email or username cannot be left blank.";
        username.style.borderColor = "red";
    } 
    else if(username.value.length >= 1 && username.value.length <= 6) 
    {
        usernameErrorMsg.innerText = "Email or username must be longer than 6 characters.";
        username.style.borderColor = "red";
    } 
    else if(username.value.length >= 24)
    {
        usernameErrorMsg.innerText = "Email or username must be shorter than 24 characters.";
        username.style.borderColor = "red";
    }
    else
    {
        username.style.borderColor = "yellow";
    }

    // Password validation
    if(password.value == "" || password.value == null)
    {
        passwordErrorMsg.innerText = "Password cannot be left empty.";
        password.style.borderColor = "red";
    }
    else if(password.value.length >= 1 && password.value.length <= 6) 
    {
        passwordErrorMsg.innerText = "Password must be longer than 6 characters.";
        password.style.borderColor = "red";
    } 
    else if(password.value.length >= 16)
    {
        passwordErrorMsg.innerText = "Password must be shorter than 16 characters.";
        password.style.borderColor = "red";
    }
    else
    {
        password.style.borderColor = "yellow";
    }
    
    // only submit the form when there are no validation errors
    if (!usernameErrorMsg.innerText && !passwordErrorMsg.innerText) 
    {
        form.submit();
    }
});
