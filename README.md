# UBC Forums (MyDiscussionForum Website)

Watch Me! 👉 [Demo](https://youtu.be/TDteoTtE2fo)

<img width="1439" alt="Image" src="https://github.com/user-attachments/assets/7766bd0f-ac44-4ace-9ac1-be367652876d" />

# Description

This project was completed for COSC360 Web Development By:

- Adam Badry (92262062)
- Tanner Dyck (65670747)
- Joy Umejiego (81265373)


## Project Goal ##
    Create a website for users to interact freely with other students and faculty at the university of british columbia. This application is similar to other forums such as Reddit and HackerNews.

## Project Deliverables ##

Terminology:
    - Forum admin is referred to as FAdmin.
    - Site admin is referred to as SAdmin.
    - User refers to any client acting outside of an admin context.

## System Requirements ##

    MAJOR (Foundational):
        - Hand-styled layout with contextual menus. (i.e. when a user has logged on to the site, menus reflect the change). 
        - 2 or 3-column layout using appropriate design principles. (i.e. highlighting nav links when hovered over, etc) 
        - Form validation with JavaScript.
        - Server-side scripting with PHP.
        - Data storage in MySQL.
        - Appropriate security for data.
        - Site must maintain state. (user state being logged on, etc)
        - Responsive design philosophy. (minimum requirements for different non-mobile display sizes)
        - AJAX (or similar) utilization for asynchronous updates. (meaning that if a discussion thread is updated, another user who is viewing the same thread will not have to refresh the page to see the update)
        - User images (thumbnail) and profile stored in a database.
        - Simple discussion (topics) grouping and display.
        - Navigation breadcrumb strategy. (i.e. users can determine where they are in threads)
        - Error handling. (bad navigation)
        - Allow seperate forums for different clubs.
        

    MINOR (Additional):
        - Search and analysis for topics/items.
        - Hot threads/hot item tracking.
        - Activity by date.
        - Collapsible items/treads without page reloading.
        - Alerts on page changes.
        - Styling flourishes.
        - Responsive layout for mobile.
        - Tracking comment history from a user’s perspective.
        - Accessibility. (Alt text for images, screen reader support?)
        
## User Requirements ##

    Unregistered Users:
        MAJOR:
            - Allow users to register with an email and password
            - Allow users to view content without an account

        MINOR:
            - Allow Forum managers to "Pin" posts so that they are seen first when the forum is viewed.
            - AJAX posts marked as threads, so users may interact with each other live.
            - Collapsable threads.

    Registered Users:
        MAJOR:
            - Show User login state through manipulation of UI elements
            - Allow Users to log out
            - Allow Users to delete their accounts
            - Allow users to like and dislike content.
            - Allow Users to sort posts by popular, user interaction, and date.
            - Allow Users to comment on posts.
        MINOR:
            - Allow Users to delete comments and posts

    Administrators:
        MAJOR:
            - SAdmin should be able to ban users from the site.
            - FAdmin should be able to ban/kick users from forums.
            - FAdmin should be able to view/remove posts on forums.
            
        MINOR:
            - FAdmin should be able to invite people to moderate. 
            - FAdmin should be able to remove moderators that are newer than them.
            - FAdmin should be able to pin posts.
