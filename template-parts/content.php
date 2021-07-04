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
			<?php 
 
 woocommerce_mini_cart( $args );
 
 ?>
			<div class="row mb-5">
					<div class="left-bordered col-md-12 px-4">
						<div class="blog_title_main">
							<?php
							if (is_singular()) :
								the_title('<h1 class="entry-title">', '</h1>');
							else :
								the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
							endif;
							?>
						</div>
						<div class="excerpt_main">

							<?php 
							 if (has_excerpt()) {
								the_excerpt();
							}
							 ?>
						</div>

					</div>
				</div>
			</header><!-- .entry-header -->

			<div class="row px-2 mb-5">
				<div class="col-md-12">
					<?php stephen_dinsmore_post_thumbnail(); ?>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-12">
					<div class="blog-entry-content">
						<?php
						the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'stephen-dinsmore'),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post(get_the_title())
							)
						);

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__('Pages:', 'stephen-dinsmore'),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->

				</div>
				
			</div>
			


			<footer class="entry-footer">
				<?php //stephen_dinsmore_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div>
</div>