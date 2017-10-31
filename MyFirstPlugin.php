<?php
/*
Plugin Name: My First Plugin
Plugin URI: http://www.example.com
Description: This is one cool plugin yo.
Author: Birgit
Version: 1.0
Author URI: http://www.madaphrodite.com
*/
add_action('admin_menu', 'myfirstplugin_admin_actions');
function myfirstplugin_admin_actions() {
    add_options_page('MyFirstPlugin', 'MyFirstPlugin', 'manage_options', _FILE_, 'myfirstplugin_admin');
}

function myfirstplugin_admin()
{
?>
        <div class="wrap">
        <h2>A more AWESOMELY AWESOME Plugin, man</h2>
        <h3>A yadayada text here idk</h3>
        <p>Hey! PSSST!!! Click the button BELOW!</p>
            </br>
        <form action="" method="POST">
            <input type="submit" name="search_draft_posts" value="Search" class="button-primary" />
        </form>
            </br>
        <table class="widefat">
        <thead>
        <tr>
        <th>Post Title</th>
        <th>Post ID</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
        <th>Post Title</th>
        <th>Post ID</th>
        </tr>
        </tfoot>
        <tbody>
<?php   
    global $wpdb;
    $mytestdrafts = array();
    if(isset($_POST['search_draft_posts']))
    {
        
        $mytestdrafts = $wpdb->get_results(
            "SELECT ID, post_title
            FROM $wpdb->posts
            WHERE post_status = 'draft'");
        
        update_option('myfirstplugin_draft_posts', $mytestdrafts); //store the results in WP options table
    }
    else if (get_option('myfirstplugin_draft_posts'))
    {
        $mytestdrafts = get_option('myfirstplugin_draft_posts');
    }
    foreach ($mytestdrafts as $mytestdraft)
    {
?>
       <tr>
<?php
        echo"<td>".$mytestdraft->post_title."</td>";
        echo"<td>".$mytestdraft->ID."</td>";
?>
       </tr>
<?php
    }
?>
        </tbody>
        </div>
<?php
}
?>