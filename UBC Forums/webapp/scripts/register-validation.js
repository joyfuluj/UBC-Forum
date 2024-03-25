// Create all variables for field values.
const form = document.getElementById("register-form");
const fname = document.getElementById("fname");
const lname = document.getElementById("lname");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password1 = document.getElementById("password1");
const password2 = document.getElementById("password2");
const usernameErrorMsg = document.getElementById("username-error");
const emailErrorMsg = document.getElementById("email-error");
const passwordErrorMsg = document.getElementById("password-error");
const fnameErrorMsg = document.getElementById("fname-error");
const lnameErrorMsg = document.getElementById("lname-error");

// Validate all field values and display error messages when necessary.
form.addEventListener("submit", (e) => 
{
    e.preventDefault(); // prevent form from submitting by default

    // Clear previous error messages
    fnameErrorMsg.innerText = "";
    lnameErrorMsg.innerText = "";
    usernameErrorMsg.innerText = "";
    emailErrorMsg.innerText = "";
    passwordErrorMsg.innerText = "";

    // Government name validation
    if(fname.value == "" || fname.value == null) 
    {
        fnameErrorMsg.innerText = "First name cannot be left empty.";
        fname.style.borderColor = "red";
    }
    else
    {
        fname.style.borderColor = "green";
    } 

    if(lname.value == "" || lname.value == null) 
    {
        lnameErrorMsg.innerText = "Last name cannot be left empty.";
        lname.style.borderColor = "red";
    }
    else
    {
        lname.style.borderColor = "green";
    }

    // Username validation
    if(username.value == "" || username.value == null) 
    {
        usernameErrorMsg.innerText = "Username cannot be left empty.";
        username.style.borderColor = "red";
    } 
    else if(username.value.length >= 1 && username.value.length <= 6) 
    {
        usernameErrorMsg.innerText = "Username must be longer than 6 characters.";
        username.style.borderColor = "red";
    } 
    else if(username.value.length >= 24)
    {
        usernameErrorMsg.innerText = "Username must be shorter than 24 characters.";
        username.style.borderColor = "red";
    }
    else
    {
        username.style.borderColor = "green";
    }

    // Email validation
    if(email.value == "" || email.value == null) 
    {
        emailErrorMsg.innerText = "Email cannot be left empty.";
        email.style.borderColor = "red";
    } 
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value))
    {
        emailErrorMsg.innerText = "Please enter a valid email address.";
        email.style.borderColor = "red";
    }
    else
    {
        email.style.borderColor = "green";
    }

    // Password validation
    if (password2.value !== password1.value) 
    {
        passwordErrorMsg.innerText = "Passwords do not match. Please try again.";
        password1.style.borderColor = "red";
        password2.style.borderColor = "red";
    }
    else if(password1.value == "" || password1.value == null || password2.value == "" || password2.value == null)
    {
        passwordErrorMsg.innerText = "Password cannot be left empty.";
        password1.style.borderColor = "red";
        password2.style.borderColor = "red";
    }
    else if(password1.value.length >= 1 && password1.value.length <= 6) 
    {
        passwordErrorMsg.innerText = "Password must be longer than 6 characters.";
        password1.style.borderColor = "red";
        password2.style.borderColor = "red";
    } 
    else if(password1.value.length >= 16)
    {
        passwordErrorMsg.innerText = "Password must be shorter than 16 characters.";
        password1.style.borderColor = "red";
        password2.style.borderColor = "red";
    }
    else
    {
        password1.style.borderColor = "green";
        password2.style.borderColor = "green";
    }

    // only submit the form when there are no validation errors
    if (!fnameErrorMsg.innerText && !lnameErrorMsg.innerText && !usernameErrorMsg.innerText && !emailErrorMsg.innerText && !passwordErrorMsg.innerText) 
    {
        form.submit();
    }
});
