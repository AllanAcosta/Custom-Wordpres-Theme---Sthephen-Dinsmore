<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stephen_Dinsmore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>

    <?php wp_head(); ?>
    <script>
    jQuery(window).load(function() {
        jQuery('.grid').masonry({
            // optiones
            itemSelector: '.grid-item',
            singleMode: true,


            percentPosition: true,

        });
    });
    </script>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text"
            href="#primary"><?php esc_html_e('Skip to content', 'stephen-dinsmore'); ?></a>

        <div class="container">
            <div class="row pt-5">
                <div class="col-12 col-lg-4">
                    <header id="masthead" class="site-header">
                        <div class="site-branding">
                            <?php
							the_custom_logo();
							if (is_front_page() && is_home()) :
							?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                    rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php
							else :
							?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                    rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php
							endif;
							$stephen_dinsmore_description = get_bloginfo('description', 'display');
							if ($stephen_dinsmore_description || is_customize_preview()) :
							?>
                            <p class="site-description">
                                <?php echo $stephen_dinsmore_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
									?>
                            </p>
                            <?php endif; ?>
                        </div><!-- .site-branding -->
                        <nav class="main-navbar navbar navbar-expand-lg navbar-light">
                            <div class="container-fluid p-0">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">

                                    <?php
									wp_nav_menu(
										array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'primary-menu',
										)
									);
									?>
                                </div>
                                
                            </div>
                            
                        </nav>
                        <div class="about-aside-info">
                                <p>
                                    2303 Harrison Avenue <br>
                                    Lincoln, Nebraska 68502 <br>
                                    Cell: 402 730-3610 <br>
                                </p>
                                <p>(July thru September, studio in Maine: 207-733-2837)</p>
                                <p><a href="#">Privacy Policy</a> | ©2021</p>
                            </div>
                    </header><!-- #masthead -->
                </div>