# 360 Final Project
# Declared requirments

## System Requirements:

    MAJOR (Foundational):
        - Hand-styled layout with contextual menus. (i.e. when a user has logged on to the site, menus reflect the change). 
        - 2 or 3-column layout using appropriate design principles. (i.e. highlighting nav links when hovered over, etc) 
        - Form validation with JavaScript. (Everyone)
        - Server-side scripting with PHP. (Everyone)
        - Data storage in MySQL. (Everyone)
        - Appropriate security for data. (Everyone)
        - Site must maintain state. (user state being logged on, etc) (Everyone)
        - Responsive design philosophy. (minimum requirements for different non-mobile display sizes) (Adam)
            relative units are used where appropriate and the website is very capable of resizing
        - AJAX (or similar) utilization for asynchronous updates. (meaning that if a discussion thread is updated, another user who is viewing the same thread will not have to refresh the page to see the update) (Adam)
            The page progressively fetches posts and comments according to the filter being used and are fetched in groups of 25 as the user scrolls so that it doesnt flood the site with every post in the database, and inserts new posts that you had missed due to the sort so that new posts are always shown to the user
        - User images (thumbnail) and profile stored in a database. (Tanner)
            I opted to store the image files on the server, and the uniquely generated file paths to the database for access later. I also experimented with storing them as BLOBs, but I preferred the former.
        - Simple discussion (topics) grouping and display. (Adam)
            Comments are isolated between posts and posts are easily grouped within their communities/forums
        - Navigation breadcrumb strategy. (i.e. users can determine where they are in threads) (Joy)

        - Error handling. (bad navigation) (Everyone)
            All of our php pages are protected fully and redirect to appropriate pages, eg trying to view forums while not logged in
        - Allow seperate forums for different clubs. (Joy)
        

    MINOR (Additional):
        - Search and analysis for topics/items. (Adam)
            The search bar finds all near matches in a title for a given string
        - Hot threads/hot item tracking. (Adam)
            The user can filter by promos
        - Activity by date. (Adam)
            The user can filter by date Ascending or Descending
        - Collapsible items/treads without page reloading. (Adam)
            Comment sections are collapsable by the user 
        - Alerts on page changes. (Joy and Adam)
            Page will give alerts for new, unviewed posts by flashing the home button
        - Styling flourishes. (Adam)
            While The entire team did help with Styling It was up to me to refine it so that it was consistent and visual bugs were absent
        - Responsive layout for mobile. (Adam)
            By Using media queries and scripts to make our menus into overlays I was able to create a well built mobile site!
        - Tracking comment history from a user’s perspective. (Tanner)
        - Accessibility. (Alt text for images, screen reader support?) (Adam)
            We gave users the ability to add titles to describe their posts and labeled everything with proper landmark roles to support the usage of screen readers
        
## User Requirements:

### Unregistered Users:
    MAJOR:
        - Allow users to register with an email and password (Tanner)
            Users can register on the register page, all fields are validated with javascript.
        - Allow users to view content without an account (Everyone)
            Users can view popular and posts/comments without an account

    MINOR:
        - Allow Forum managers to "Pin" posts so that they are seen first when the forum is viewed.
            Forum Managers can pin posts in the community page
        - AJAX posts marked as threads, so users may interact with each other live.(Adam)
            All comment sections are live updated with the most recent comments using polling and progressively loading comments as the user scrolls
        - Collapsable threads. (Adam)
            Comments sections, and option menus in mobile sites are collapsable. The User can clear the comments by clicking the close button

### Registered Users:
    MAJOR:
        - Show User login state through manipulation of UI elements (Adam)
            Login Button is replaced by the username of the logged in user
        - Allow Users to log out (Tanner)
            Users can log out from the header using a simple PHP script
        - Allow Users to delete their accounts (Tanner)
            Users can deleted their account from the Account page
        - Allow users to like content. (Adam and Tanner)
                Users can "Promo" content to give it a boost on popular sorting
        - Allow Users to sort posts by popular, user interaction, and date (Adam)
            Users Can sort by the amount of promos(Likes), oldest or newest first, or lack of promos 
        - Allow Users to comment on posts. (Adam)
            Users can comment on any posts
    MINOR:
        - Allow Users to delete comments and posts (Tanner)
            Users can delete their own comments from anywhere on the site, and delete their posts from their account dashboard.
            Site Admins can delete all comments.

### Administrators:
    MAJOR:
        - SAdmin should be able to delete users from the site. (Tanner)
            Site admins possess the ability to delete all posts, users, and comments on the wbesite.

        - FAdmin should be able to ban/kick users from forums.

        - FAdmin should be able to view/remove posts on forums.
        
    MINOR:
        - FAdmin should be able to invite people to moderate. 

        - FAdmin should be able to remove moderators that are newer than them.
        
        - FAdmin should be able to pin posts.



# Additional functionality

## Search and analysis for topics/items
## Hot threads/hot item tracking
## Visual display of updates, etc (site usage charts, etc)
## Activity by date
## Tracking (including utilizing tracking API or your own with visualization tools)
## Collapsible items/treads without page reloading
## Alerts on page changes
## Admin view reports on usage (with filtering)
## Styling flourishes
## Responsive layout for mobile
## Tracking comment history from a user’s perspective
## Accessibility


## Adams Contributions

### Styling

### Mobile Friendly Design

### Accessability

### Post Fetching

### Comment Fetching

### Comment AJAX Updating

### Search Functionality and post filtering

### Admin Functionality

### Promo Server Script



