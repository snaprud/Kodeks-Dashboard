<?php
/*
Plugin Name: Kodeks Dashboard
Plugin URI: http://kodeks.no
Description: This plugin customizes the WordPress dashboard.
Version: 1.1
Author: Thomas Johannessen
Author URI: http://kodeks.no
License: GPLv2
*/


// remove unwanted dashboard widgets for relevant users
function remove_dashboard_meta() {
    remove_action('welcome_panel', 'wp_welcome_panel');
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
    remove_meta_box( 'jetpack_summary_widget', 'dashboard', 'normal' );
    remove_meta_box( 'tribe_dashboard_widget', 'dashboard', 'normal' );
    
}
add_action( 'admin_init', 'remove_dashboard_meta' );

/* Move the 'Right Now' dashboard widget to the right hand side
function move_dashboard_widget() {
    $user = wp_get_current_user();
    if ( ! $user->has_cap( 'manage_options' ) ) {
        global $wp_meta_boxes;
        $widget = $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'];
        unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
        $wp_meta_boxes['dashboard']['side']['core']['dashboard_right_now'] = $widget;
    }
}
add_action( 'wp_dashboard_setup', 'move_dashboard_widget' ); */

// add new dashboard widgets
function add_dashboard_widgets() {
    wp_add_dashboard_widget( 'dashboard_welcome', 'Velkommen', 'add_kodeks_welcome_widget' );
    wp_add_dashboard_widget( 'dashboard_links', 'Nyttige tips', 'add_links_widget' );
}

function add_kodeks_welcome_widget(){ ?>

<h1>Hei <?php $current_user = wp_get_current_user(); echo $current_user->user_firstname; ?>,</h1>

<p>Vi jobber kontinuerlig for at du skal kunne redigere dine nettsider så enkelt som mulig. Ved hjelp av Wordpress har dere total kontroll over alle deler av deres websider. Du kan selv oppdatere tekst, bilder og dokumenter på alle sider.</p>


<p>Har du spørsmål til den nye løsningen, eller ønsker oppdateringer på siden er du velkommen til å ta kontakt med vår kundeservice:</p>

<p>Epost: <strong>hei@kodeks.no</strong><br />
    Telefon:<span class="icon"></span> <strong>+47 21 00 01 01</strong> <br/> </p>
<p><strong><a href="http://kodeks.no/kontakt" target="_blank">Finn kontaktperson her</a></strong></p>


<?php }

function add_links_widget() { ?>

<h2>Nyttige tips</h2>

<p>Some links to resources which will help you manage your site:</p>

<ul>
    <li><a href="http://wordpress.org">The WordPress Codex</a></li>
    <li><a href="http://easywpguide.com">Easy WP Guide</a></li>
    <li><a href="http://www.wpbeginner.com">WP Beginner</a></li>
</ul>

<?php }
add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );

?>