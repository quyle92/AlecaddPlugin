<?php
if( ! defined ('WP_UNINSTALL_PLUGIN '))
	die;

//clear database storage data (simple method)
$books = get_posts( array( 'post_type' => 'book', 'numberposts' => -1 ));
foreach ($books as $book) {
	wp_delete_post( $book->ID, true );
}

//Access Database via SQL (comprehensive method)
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'");
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (select id from wp_posts") );
$wpdb->query( "DELETE FROM wp_terms_relationships WHERE object_id NOT IN (select id from wp_posts"));
