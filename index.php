<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Hymns_and_Aries
 */

if (isset($_POST['message_name'])) {
    $name = $_POST['message_name'];
    $email = $_POST['message_email'];
    $subject = $_POST['message_subject'];
    $message = $_POST['message_message'];

//php mailer variables
    $to = get_option('admin_email');
    $subject = "Someone sent a message from " . get_bloginfo('name');
    $headers = 'Reply-To: ' . $email . "\r\n";

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (!empty($name) && !empty($message)) {
            $sent = wp_mail($to, $subject, strip_tags($message), $headers);
            if ($sent) {
                $response = "Message sent successfuly";
            } else {
                $response = "There was an unknown error!";
            }
        } else {
            $response = "Invalid data";
        }
    } else {
        $response = "Invalid email";
    }
}

get_header(); ?>

    <!-- Bnr Head -->
    <section class="bnr-head">
        <div class="container">
            <div class="position-center-center">
                <img id="logo" class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="" >
                <p>
                    <?php
                    $page = get_page_by_title( 'About' );
                    $the_excerpt = $page->post_excerpt;
                    print $the_excerpt;
                    ?>
                </p>
                <?php
                    if (isset($response)) {
                        ?>
                        <div class="alert alert-info" role="alert"><?php echo $response ?></div>
                        <?php
                    }
                ?>
                <a id="contactUsButton" href="#contactModal" data-toggle="modal" class="btn">Contact Us</a></div>
        </div>
        <style>
            #logo {
                height: 300px;
                width: 300px;
            }
        </style>
        <script>
            const $bnrHead = $(".bnr-head");
            let lastMusicIndex = -1;
            let lastMemberIndex = -1;
            const fadeInImages = () => {
                $bnrHead.height($(window).height());
                $(".discover-music li").each(function (index) {
                    let image = $(this);
                    let imgOffsetTop = image.offset().top;
                    let pageScroll = $(window).scrollTop() + $(window).height();
                    if (pageScroll > imgOffsetTop) {
                        setTimeout(function () {
                            if (image.css("visibility") === "hidden") {
                                image.css({"visibility": "visible"}).hide()
                            }
                            image.fadeIn(2000);
                            console.log(image);
                            lastMusicIndex = index;
                        }, (500 * (index - lastMusicIndex)));
                    }
                });
                $(".portfolio article").each(function (index) {
                    let image = $(this);
                    let imgOffsetTop = image.offset().top;
                    let pageScroll = $(window).scrollTop() + $(window).height();
                    if (pageScroll > imgOffsetTop) {
                        setTimeout(function () {
                            if (image.css("visibility") === "hidden") {
                                image.css({"visibility": "visible"}).hide()
                            }
                            image.fadeIn(2000);
                            console.log(image);
                            lastMemberIndex = index;
                        }, (500 * (index - lastMemberIndex)));
                    }
                });
            };
            $(fadeInImages);
            $(() => {
                $("#contactUsButton").fadeOut(1).fadeIn(1000);
                $(".discover-music li").css({"visibility": "hidden"});
                $(".portfolio article").css({"visibility": "hidden"});
            });
            $(window).on("resize", fadeInImages);
            $(window).on("scroll", fadeInImages);
        </script>
        <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="container">
                        <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a> Contact Us</h6>
                        <!-- Forms -->
                        <form action="" method="post">
                            <ul class="row">
                                <li class="col-xs-12">
                                    <input type="text" name="message_name" placeholder="Name">
                                </li>
                                <li class="col-xs-6">
                                    <input type="text" name="message_email" placeholder="Email">
                                </li>
                                <li class="col-xs-6">
                                    <input type="text" name="message_subject" placeholder="Subject">
                                </li>
                                <li class="col-xs-12">
                                    <textarea name="message_message" placeholder="Your Message"></textarea>
                                </li>
                                <li class="col-xs-12 text-center">
                                    <button class="btn btn-primary" type="submit">Send message</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="discover">
        <div class="container">
            <div class="main-heading">
                <h3>What we Offer</h3>
                <hr>
            </div>
            <div class="discover-music pic-dis">
                <ul class="row">
                    <?php
                    $offers = array();
                    $args = array( 'post_type' => 'offer', 'posts_per_page' => 6 );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $offers[] = array('id' => get_the_ID(), 'content' => get_the_content(), 'title' => get_the_title());
                        ?>
                        <li class="col-sm-4"> <img class="img-responsive" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="" >
                            <a href="#<?php the_ID()?>Modal" class="btn btn-primary btn-lg" data-toggle="modal"><?php the_title(); ?></a>
                        </li>
                        <?php
                    endwhile;
                    ?>
                </ul>
            </div>
            <?php
            foreach ($offers as $offer):
                ?>
                <div class="modal fade" id="<?php echo $offer['id']; ?>Modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a> <?php echo $offer['title']; ?></h6>
                            </div>
                            <div class="modal-body">
                                <?php echo $offer['content']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                endforeach;
            ?>
        </div>
    </section>

    <!-- About -->
    <section class="portfolio port-wrap discover-music padding-top-80 padding-bottom-80 filter-index about-page">
        <div class="container">

            <div class="container">
                <div class="main-heading">
                    <h3>Meet Us</h3>
                    <hr>
                </div>
                <div class="items row col-4">
                    <?php
                    $people = array();
                    $args = array( 'post_type' => 'person', 'posts_per_page' => 1000 );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $people[] = array('id' => get_the_ID(), 'content' => get_the_content(), 'title' => get_the_title());
                        ?>
                        <article class="media-item">
                            <div class="media-image"> <a href="#."> <img alt="" src="<?php print get_the_post_thumbnail_url()?>"> </a> </div>
                            <div class="media-overlay">
                                <div class="position-center-center">
                                    <a href="#<?php the_ID()?>Modal" class="btn btn-primary btn-lg view-detail" data-toggle="modal">View</a>
                                </div>
                            </div>
                            <div class="item-name"> <span><?php print get_post_meta(get_the_ID(), 'position', true) ?></span>
                                <h6><?php the_title() ?></h6>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>
                <?php
                foreach ($people as $person):
                    ?>
                    <div class="modal fade" id="<?php echo $person['id']; ?>Modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6><a class="close" href="#." data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></a> <?php echo $person['title']; ?></h6>
                                </div>
                                <div class="modal-body">
                                    <?php echo $person['content']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
    </section>

    <!-- Latest News -->
    <section class="latest-release">
        <div class="container">
            <div class="main-heading">
                <h3>latest news</h3>
                <hr>
            </div>
            <?php
                $args = array( 'post_type' => 'post', 'posts_per_page' => 1000 );
                $loop = new WP_Query( $args );
            ?>
            <div class="row">
            <!-- Latest News -->
            <?php
                $loop->the_post();
                ?>
                <div class="col-md-6">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                        <div class="botm-text"> <span><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; }?></span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                    </article>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                    <?php
                    while ( $loop->have_posts() ) : $loop->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                            <div class="botm-text"> <span><?php foreach((get_the_category()) as $category) { echo $category->cat_name . ' '; }?></span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                        </article>
                        <?php
                    endwhile;
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
