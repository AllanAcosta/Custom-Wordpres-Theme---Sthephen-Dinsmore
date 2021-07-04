<?php

/**
 * The template for displaying the about page.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Blog
 *
 * @package storefront
 */

get_header();
?>

<div class="col-12 col-lg-8">
	
	<main id="primary" class="site-main">
	<div class="row">
		<?php
		if (have_posts()) :

			if (is_home() && !is_front_page()) :
		?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>


			<?php
			endif;
			/* Start the Loop */
			while (have_posts()) :
				the_post();
			?>
				<div class="col-md-6">
					<?php
					get_template_part('template-parts/content_main_blog', get_post_type());
					?>
				</div>
		<?php

			endwhile;

			the_posts_navigation();

		else :

			get_template_part('template-parts/content_main_blog', 'none');

		endif;
		?>


	</main><!-- #main -->
	</div>
</div>

<?php

get_footer();
