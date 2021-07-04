<?php

/**
 * The template for displaying the about page.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: About
 *
 * @package storefront
 */


get_header();
?>
<div class="col-12 col-lg-8">
	<main id="primary" class="site-main row site-404-page">
		<div class="col-lg-12 text-center">
			<?php
			the_custom_logo();
			?>
			<h2 class="mt-3 mb-5">404 Page Not Found</h2>
			<a href="<?php echo home_url(); ?>">Back to Homepage</a>
			<br>
			<br>
			<a href="<?php echo (get_permalink(wc_get_page_id('shop')));?>">Back to Shopping Page</a>
		</div>
		<!-- #main -->
	</main>
</div>
</div>
</div>
</div>

<?php
get_footer();
