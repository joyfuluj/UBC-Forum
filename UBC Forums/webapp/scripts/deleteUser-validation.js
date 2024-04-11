// Create all variables for field values.
const adminForm = document.getElementById("admin-form");
const submit = document.getElementById("admin");
const password2 = document.getElementById("password2");
const delError = document.getElementById("delError");

// Validate all field values and display error messages when necessary.
delAccountForm.addEventListener("submit", (e) => 
{
    e.preventDefault(); // prevent form from submitting by default

    // Clear previous error messages
    delError.innerText = "";

    // Password validation
    if (password1.value !== password2.value) 
    {
        delError.innerText = "Passwords do not match. Please try again.";
        password1.style.borderColor = "red";
        password2.style.borderColor = "red";
    }
    else if(password1.value == "" || password1.value == null || password2.value == "" || password2.value == null)
    {
        delError.innerText = "Fields cannot be left empty.";
        password1.style.borderColor = "yellow";
        password2.style.borderColor = "yellow";
    }
    else if(password1.value.length <= 6 || password2.value.length <= 6)
    {
        delError.innerText = "Passwords must be longer than 6 characters.";
        password1.style.borderColor = "yellow";
        password2.style.borderColor = "yellow";
    }
    else if(password1.value.length >= 16 || password2.value.length >= 16)
    {
        delError.innerText = "Passwords cannot be longer than 16 characters.";
        password1.style.borderColor = "yellow";
        password2.style.borderColor = "yellow";
    }
    else
    {
        password1.style.borderColor = "green";
        password2.style.borderColor = "green";
    }

    // Only submit the form when there are no validation errors
    if (!delError.innerText) 
    {
        if(!confirm("Are you sure you want to delete your account?"))
        {
            e.preventDefault();
        }
        delAccountForm.submit();
    }
});
