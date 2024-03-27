<?php
// Define your breadcrumb items
$breadcrumbs = array(
    'Home' => 'index.php',
    'Post' => 'post.php',
    'Forum' => 'forum.php',
    'Dashboard' => 'dashboard.php',
);

// Get the current filename from the URL
$current_url = basename($_SERVER['PHP_SELF']);
$current_page_name = $current_page_info['filename'];



// Generate breadcrumb navigation
echo '<ul class="breadcrumb">';
foreach ($breadcrumbs as $label => $url) {
    // Check if the URL matches the current filename
    if ($url === $current_url) {
        echo '<li id="current">' . $label . '</li>';
        break; // End the loop
    } else {
        echo '<li><a href="' . $url . '">' . $label . '</a>/</li>';
    }
}
echo '</ul>';
