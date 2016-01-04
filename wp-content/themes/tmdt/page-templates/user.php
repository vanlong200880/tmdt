<?php
/**
 * Template Name: User Profile
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
<?php 
$args = array(
    'author'        =>  $current_user->ID,
    'orderby'       =>  'post_date',
    'order'         =>  'ASC',
    'posts_per_page' => 1
    );

?>
<?php get_footer(); ?>