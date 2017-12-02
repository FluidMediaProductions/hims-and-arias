<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hymns_and_Aries
 */

get_header();
the_post();?>

    <section class="sub-bnr">
        <div class="position-center-center">
            <div class="container">
                <h2><?php the_title(); ?></h2>
            </div>
        </div>
    </section>

    <section class="padding-top-80 padding-bottom-80 about-page">
        <div class="container">
            <?php
            the_content();
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        </div>
    </section>

<?php
get_footer();
