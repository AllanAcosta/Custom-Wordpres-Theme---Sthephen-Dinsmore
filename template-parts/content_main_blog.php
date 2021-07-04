<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Stephen_Dinsmore
 */

?>
<div class="row">
    <div class="col-md-12">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <div class="row">
                    <div class="col-md-12">
                        <?php stephen_dinsmore_post_thumbnail(); ?>
                    </div>
                </div>
            </header><!-- .entry-header -->

            <div class="row">
                <div class="col-md-12">
                    <div class="blog_post_info_container border border-dark px-3 py-4">
                        <div class="blog_title_main">

                            <?php

                            if (is_singular()) :
                                the_title('<p class="blog_entry_title m-0">', '</p>');
                            else :
                                the_title('<p class="blog_entry_title m-0"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></p>');
                            endif;
                            ?>

                            <p><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></p>
                            <div class="blog-entry-content">
                                <?php
                                the_excerpt();

                                wp_link_pages(
                                    array(
                                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'stephen-dinsmore'),
                                        'after'  => '</div>',
                                    )
                                );
                                ?>
                            </div><!-- .entry-content -->

                        </div>
                        <div class="read_more_button text-center text-uppercase"><a href="<?php the_permalink(); ?>">Read More</a></div>
                    </div>
                </div>
            </div>


        </article><!-- #post-<?php the_ID(); ?> -->
    </div>
</div>