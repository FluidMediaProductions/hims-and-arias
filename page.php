<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
            ?>
        </div>
    </section>

<?php
get_footer();
