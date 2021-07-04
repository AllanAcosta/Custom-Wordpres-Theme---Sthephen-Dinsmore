<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Stephen_Dinsmore
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
