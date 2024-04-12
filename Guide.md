# Testing
    As A Group we decided that we would do manual testing, and as such have tried to test every edge case as weve built our functions
    our testing process can be found in our Error Handling and Validation Document

# Our Favorite Features
    Our Team believes we deserve the highest possible grade, as not only are all of our sites abilities fully functional, but we also took great consideration for scalability and efficiency. Our site doesnt store any posts or images in the database, allowing us to easily scale and implement new features for our users to edit their own posts and such. The AJAX Adam implemented also loads posts progressivly, stopping the server from overserving a client, and stopping a clients machine from being flooded as the posts database and comments database grows. We were also Extremely Proud of our mobile site design and its implementation of many user friendly design philosophies 
    Below is a list of all our favorite features for our users

## AJAX Post and comment fetching
    Our AJAX Post fetching Uses a last fetched time and a scroll detector to load new posts as the user scrolls, allowing them to keep viewing posts without being interupted
    The last fetch time is used to get new comments/posts without refreshing the page, or placing them near the top of the page away from the users view.
    This serves to minimize the client and Server resources for loading posts and comments, as it only loads enough for the user to view at one time. This also keeps all feeds 'Live' in that the user never needs to refresh to see the newest posts 

## Mobile site
    Our Mobile Site is awesome, looking nearly like a full webapp, with pop up menus and proper styling
    What more needs to be said? 


## Search and analysis for topics/items
    Posts are searchable by using the titles, and can be filtered while searched
## Hot threads/hot item tracking
    Items can be searched based on the number of promos in a way to find hot/popular items

## Visual display of updates, etc (site usage charts, etc)
    The site Flashes the home button to alert the user to new posts available in the feed

## Activity by date
    the site sorts comments/posts by date automatically and the 

## Tracking (including utilizing tracking API or your own with visualization tools)
    We did not utilize an external tracking API, but we did implement member tracking for communities in order to best understand usage

## Collapsible items/treads without page reloading
    comment sections are collapsed back into the post after clicking the close button

## Alerts on page changes
    The server alerts the client on changes in the feed by flashing the home button

## Admin view reports on usage (with filtering)
    Admin can view and delete any activity on the site, so they can use the forums page to sort and view usage, there are no specific reports as we did not know what we would be reporting on

## Styling flourishes
    Styling is insanely cool and awesome, I mean look at the mobile site. Clearly the best

## Responsive layout for mobile
    Our site is completely compatible with mobile. having its own dedicated site design but the responsiveness doesnt stop there. The site can easily be resized to fit any screen size or browser size without a hitch

## Tracking comment history from a user’s perspective
    Users can view any of their posts/comments from their profile page

## Accessibility
    The site is properly Setup for Landmark roles for screen readers, and the usage of user titles helps to describe content for said posts, allowing screen readers to scrape posts semi consistently. there could be some improvements as we did not have the full time to experiment with screen readers but we gave it a good effort I think. We also used a bright and highly contrasting color pallete to improve usage for our color blind users    




# How to use our Site!

## Usable Credentials
### URL:
    https://cosc360.ok.ubc.ca/joyu0218/UBC%20Forums/webapp/pages/index.php
### Admin account
    username: jdoe102
    or email: jane@gmail.com
    password: janedoepw
### User Account
    username: jdoe101
    or email: john@gmail.com
    password: johndoepw

## Registration
### Step One: go to the registration page (Top Right of Header)

### Step Two: Enter your info
#### The requirements for each will be alerted upon failure to meet each.
    This is to help reinforce users automatic usage of strong passwords, as the annoyance makes them lol
#### Step Three: Hit submit
    After submission, you will be asked to log in again with a little message saying sign up was successful

## Logging in
### Step One: Navigate to the login page from the header bar or registration page
### Step Two: Input your username/email and password
    If they are correct you will be returned to the home page and your session started

## Understanding the Account Dashboard
    To reach the account dashboard, click your account name in the top right of the header.
    The left column is reserved for the users personal posts, All accounts can view their posts and accompanying comments, post deletion is also a feature.
    The right column displays some of the users account info, and houses all available account settings:
### Regular Accounts
    Regular accounts have access to a few account options. 
    They can upload a new profile picture, Change their current password, and delete their account entirely. 
    Users must know their current password in order to modify any account information.
    All accounts have the ability to delete any posts and/or comments created by themselves via delete buttons on the element.
### Admin Accounts
    Admin accounts have access to some special settings (located beneath account settings in the right column) due to their unique priveleges.
    They can toggle between querying users or posts with a dropdown menu above the search bar
    Admin users can search the database for any and all users, and posts. They can delete any of the returned items.
    When browsing posts on the homepage dashboard, they have the option to delete any and all comments they come across.

## Navigating the posts
The home page and forum pages can both be used to view posts in specificity.
The search bar can be used to help filter posts on the homepage. 

## Commenting on a post:
### Step One: click the comment button on a post
    If you are not logged in it will send an alert asking you to login
### Step Two: type your comment in the bar and click the thumbs up
    The user will see the comment pop up

## Posting: 
### Navigate to the post page via the header
    This will prompt you to login if you are not
### Fill out the form
    A community and one type of content(text or Image) is all that is required, post titles are not
### Hit submit
    You will be greeted by a message in the post box confirming or denying your post

## Promoting a post
### Step One: press the ^ button next to the promos count
    Did I really need to say it?

## Viewing Forums
### Step One: Press "Show More" button
    You can view the discription and join/withdraw the forum

## Creating Forums
### Step One: Press "Create + " button to create a forum.
### Step Two: Put the name and description.
    You can create a forum

## Viewing Forum details
### Step One: Press the forum name
    You can view the forum details
### Step Two: Press pin/delete
    You can pin/delete the posts.
### Step Three : Press assign/unassign and delete
    You can assign/unassign users to moderate or delete the user
### Step Four: Press join/withdraw
    You can join/withdraw the related forums.

## Logging Out
    When you want to end your session on UBC Forums, navigate to the top right of the header where a logout button should be displayed beside your account dashboard link.