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
        - AJAX (or similar) utilization for asynchronous updates. (meaning that if a discussion thread is updated, another user who is viewing the same thread will not have to refresh the page to see the update) (Adam)
        - User images (thumbnail) and profile stored in a database. (Tanner)
        - Simple discussion (topics) grouping and display. (Adam)
            Comments are isolated between posts
        - Navigation breadcrumb strategy. (i.e. users can determine where they are in threads) (Joy)
        - Error handling. (bad navigation) (Everyone)
        - Allow seperate forums for different clubs. (Joy)
        

    MINOR (Additional):
        - Search and analysis for topics/items. (Adam)
        - Hot threads/hot item tracking. (Adam)
        - Activity by date. (Adam)
        - Collapsible items/treads without page reloading. (Adam)
        - Alerts on page changes. (Joy and Adam)
        - Styling flourishes. (Adam)
            While 
        - Responsive layout for mobile. (Adam)
            By Using media queries and scripts to make our menus into overlays I was Able to create a well built mobile site!
        - Tracking comment history from a user’s perspective. (Tanner)
        - Accessibility. (Alt text for images, screen reader support?) (Adam)
            We gave users the ability to add titles to describe their posts and labeled everything with
        
## User Requirements:

### Unregistered Users:
    MAJOR:
        - Allow users to register with an email and password
            Users can register on the register page
        - Allow users to view content without an account (Everyone)
            Users can view popular and recent posts/comments without an account

    MINOR:
        - Allow Forum managers to "Pin" posts so that they are seen first when the forum is viewed.
            Forum Managers can pin posts in the community page
        - AJAX posts marked as threads, so users may interact with each other live.(Adam)
            All comment sections are live updated with the most recent comments using polling and progressively loading 
        - Collapsable threads. (Adam)
            Comments sections, and option menus in mobile sites are collapsable. The User can clear the comments by clicking the close button

### Registered Users:
    MAJOR:
        - Show User login state through manipulation of UI elements (Adam)
            Login Button is replaced by the username of the logged in user
        - Allow Users to log out
            Users can log out from the header
        - Allow Users to delete their accounts
            Users can deleted their account from the Account page
        - Allow users to like content. (Adam)
                Users can "Promo" content to give it a boost on popular sorting
        - Allow Users to sort posts by popular, user interaction, and date (Adam)
            Users Can sort by the amount of promos(Likes), oldest or newest first, or lack of promos 
        - Allow Users to comment on posts. (Adam)
            Users can comment on any posts
    MINOR:
        - Allow Users to delete comments and posts
            Users can delete their own posts from their dashboard

### Administrators:
    MAJOR:
        - SAdmin should be able to ban users from the site.
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



