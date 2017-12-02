<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hymns_and_Aries
 */

?>
</div>

<!--======= RIGHTS =========-->
<div class="rights">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>© Copyright 2017 Hims and Arias. All Rights Reserved<br>
                    Made with <i class="fa fa-heart"></i> by <a href="https://fluidmedia.wales">Fluid Media Productions</a></p>
            </div>
            <div class="col-md-6">
                <ul class="social_icons">
                    <?php if (get_option('facebook_url') != '') { ?>
                        <li><a href="<?php print get_option('facebook_url') ?>"><i class="fa fa-facebook"></i> </a></li>
                    <?php } ?>
                    <?php if (get_option('twitter_url') != '') { ?>
                        <li><a href="<?php print get_option('twitter_url') ?>"><i class="fa fa-twitter"></i> </a></li>
                    <?php } ?>
                    <?php if (get_option('google_url') != '') { ?>
                        <li><a href="<?php print get_option('google_url') ?>"><i class="fa fa-google"></i> </a></li>
                    <?php } ?>
                    <?php if (get_option('soundcloud_url') != '') { ?>
                        <li><a href="<?php print get_option('soundcloud_url') ?>"><i class="fa fa-soundcloud"></i> </a></li>
                    <?php } ?>
                    <?php if (get_option('youtube_url') != '') { ?>
                        <li><a href="<?php print get_option('youtube_url') ?>"><i class="fa fa-youtube"></i> </a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</div>
</body>
</html>

