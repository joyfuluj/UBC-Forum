// Create all variables for field values.
const form = document.getElementById("change-password-form");
const old_password = document.getElementById("old_password");
const new_password1 = document.getElementById("new_password1");
const new_password2 = document.getElementById("new_password2");
const passError = document.getElementById("passError");

// Validate all field values and display error messages when necessary.
form.addEventListener("submit", (e) => 
{
    e.preventDefault(); // prevent form from submitting by default

    // Clear previous error messages
    passError.innerText = "";

    // Password validation
    if (new_password2.value !== new_password1.value) 
    {
        passError.innerText = "New passwords do not match. Please try again.";
        new_password1.style.borderColor = "red";
        new_password2.style.borderColor = "red";
    }
    else if(old_password.value == "" || old_password.value == null || new_password1.value == "" || new_password1.value == null || new_password2.value == "" || new_password2.value == null)
    {
        passError.innerText = "Fields cannot be left empty.";
        old_password.style.borderColor = "yellow";
        new_password1.style.borderColor = "yellow";
        new_password2.style.borderColor = "yellow";
    }
    else if(new_password2.value.length >= 1 && new_password2.value.length <= 6) 
    {
        passError.innerText = "New password must be longer than 6 characters.";
        new_password2.style.borderColor = "red";
        new_password2.style.borderColor = "red";
    } 
    else if(new_password2.value.length >= 16)
    {
        passError.innerText = "New password must be shorter than 16 characters.";
        new_password2.style.borderColor = "red";
        new_password2.style.borderColor = "red";
    }
    else
    {
        old_password.style.borderColor = "green";
        new_password1.style.borderColor = "green";
        new_password2.style.borderColor = "green";
    }

    // Only submit the form when there are no validation errors
    if (!passError.innerText) 
    {
        form.submit();
    }
});
