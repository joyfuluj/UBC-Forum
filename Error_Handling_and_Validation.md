# Login Validation
### This login authorization is performed in PHP, it is activated after the login credentials have been validated in javascript.
### It utiulizes the password_verify() function to determine if the hashed password matches the submitted password for the submitted username.
### - If SUCCESFUL: The user will be logged in to the site, and their credntials will be stored as $_SESSION variables.
### - IF UNSUCCESFUL: The user will be redirected back to the login page, with a simple error message. 
![Login Validation](Project%20Documents/ErrorHandling/LoginValidation.png)

# Register Email Validation
### This is a validation form that utilizes a REGEX pattern to check the validity of a submitted email address during registration. 
### It also verifies that the submitted email address is not null or empty.
### The user is met with two visual prompts to help navigate any errors after submission:
### 1) The user is met with an error message above the field that is in question.
### 2) The field in question is highlighted red if invalid, or green if valid. 
![Register Email Validation](Project%20Documents/ErrorHandling/RegisterEmailValidation.png)

# Register Password Validation
### This script is fairly straightforward and utilizes the same structure as the previous.
### It checks the submitted passwords for various conditions, namely the length requirements, and communicates any invalid fields.
![Register Password Validation](Project%20Documents/ErrorHandling/RegisterPasswordValidation.png)

# Update Password Validation
### This is the full document for updating a password within the database.
### This screenshot showcases how we assign our valriables, as well as the event listener and prevention of form submission.
### Users receive error messages in the same two visual ways as mentioned above.
### The field border turns red, and the error message appears above it.
![Update Password Validation](Project%20Documents/ErrorHandling/UpdatePasswordValidation-FULL.png)

# Update Profile Pic Validation
### This is the PHP script that handles the upload of a new profile picture. It checks two conditions:
### 1) Checks the file size of the image, if it exceeds 125 kilobytes, it won't be accepted, and an error message will display above the submission field. 
### 2) Determines the file extension of the photo against a pre-constructed array of accepted file extensions (.png, .jpg, .gif). If it is not an acceptable file type, an error message will be displayed above the submission field.  
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/UpdateProfilePicValidation.png)

# Visual Representations of Error Handling
### Below we have attached a collection of screenshots showing off some of the common errors that users may run into as they learn the flow of the website. 
### We have also tried to showcase how we have handled other requests: such as having sql queries return empty-handed, and critical interactions requiring browser confirmations.

#### Registration Error Handling
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/RegisterErrors.png)

#### Login Error Handling
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/LoginErrors.png)
#### Invalid Image Validation
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/PostOnlyImages.png)
#### Proper Post form validation
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/EmptyCommunityError.png)
#### Cant post both text and image Validation
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/InvalidPost.png)
#### Deletion confirmation
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/JavascriptConfirmation.png)
#### Search form No results handling
![Update Profile Pic Validation](Project%20Documents/ErrorHandling/NoPostsFound.png)
#### Trying to promote a post while not logged in
![alt text](Project%20Documents/ErrorHandling/notLoggedInError.png)
#### Trying to comment while not logged in
![alt text](Project%20Documents/ErrorHandling/commentNotLoggedIn.png)




# Other Errors
Other Errors are hard to show as they are often redirects, such as not being logged in but accessing a restricted site, but we welcome any bug/penetration testing!
