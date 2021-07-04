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
	
		<main id="primary" class="site-main row">
			<div class="col-lg-12">

				<div class="row pb-5">
					<div class="col-md-6 pb-3 d-flex justify-content-center">
						<?php if (has_post_thumbnail()) : ?>
							<?php stephen_dinsmore_post_thumbnail(); ?>
						<?php else : ?>
							imagen destacada aqui
						<?php endif; ?>
					</div>
					<div class="col-md-6 d-flex flex-column justify-content-center"></div>
					<!-- <div class="col-md-6 d-flex flex-column justify-content-center  custom_quote_container">
				<img class="ml-1 mb-4 align-self-start left_quote"
					src=<//?php echo ('"' . get_template_directory_uri() . '/images/quotation_mark.png"') ?> alt="">

				<p class="quote_text p-0 m-0">
					<//?php echo the_field('first_quote'); ?>
				</p>
				<img class="mt-4  ml-1 align-self-end right_quote"
					src=<//?php echo ('"' . get_template_directory_uri() . '/images/quotation_mark_reverse.png"') ?> alt="">
			</div> -->
				</div>
				<!-- <div class="row mt-4 px-4">
			<div class="left-bordered col-md-12 ml-2 pl-5 pb-5">
				<h3 class="about_artist_name">
					<//?php echo the_field('artist_name'); ?>
				</h3>
				<p class="body_big"><//?php echo the_field('city_of_birth'); ?></p>
			</div> -->

			</div>
			<div class="row left_padded_row">
				<div class="col-md-12">

					<p class="quote_text">
					<h3 class="the_title"><?php the_title(); ?></h3>
					<?php

					while (have_posts()) :
						the_post();

						get_template_part('template-parts/content', 'page');

						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
					</p>
				</div>
			</div>
			<!-- <div class="row left_padded_row">
			<div class="col-md-12 my-4 d-flex flex-column justify-content-center custom_quote_container">
				<div class="quote_title">
					<p class="align-self-start body_big pb-4">Dinsmore states:</p>
				</div>
				<img class="ml-1 mb-4 align-self-start left_quote"
					src=<//?php echo ('"' . get_template_directory_uri() . '/images/quotation_mark.png"') ?> alt="">
				<p class="quote_text p-0 m-0">
					<//?php echo the_field('second_quote'); ?>
				</p>
				<img class="mt-4  ml-1 align-self-end right_quote"
					src=<//?php echo ('"' . get_template_directory_uri() . '/images/quotation_mark_reverse.png"') ?> alt="">
			</div>
		</div> -->
			<div class="row left_padded_row mb-5">
				<div class="col-md-12">
					<div class="born_info">
						<p><b>Born:&nbsp;</b><?php echo the_field('born'); ?></p>
					</div>
					<div class="education_info">
						<p><b>Education:&nbsp;</b><?php echo the_field('education'); ?></p>
					</div>
					<div class="blue_galery_info">
						<p><b>Blue Gallery:&nbsp;</b>
							<br>
							<?php echo the_field('blue_gallery'); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>


			<div class="row mb-3">
				<div class="col-md-6 art_info_col">

					<h5 class="art_info_title mb-4">Selected Representations</h5>
					<p class="art_info_text">
						<?php echo the_field('selected_representations'); ?>
					</p>


				</div>
				<div class="col-md-6 art_info_col">
					<h5 class="art_info_title mb-4">Selected Group Shows</h5>
					<p class="art_info_text">
						<?php echo the_field('selected_group_shows'); ?>
					</p>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-md-6 art_info_col">

					<h5 class="art_info_title mb-4">Selected Collections</h5>
					<p class="art_info_text">
						<?php echo the_field('selected_colletions'); ?>
					</p>


				</div>
				<div class="col-md-6 art_info_col">
					<h5 class="art_info_title mb-4">Others</h5>
					<p class="art_info_text">
						<?php echo the_field('others'); ?>
					</p>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-md-6 art_info_col">
					<h5 class="art_info_title mb-4">Additional Representation</h5>
					<p class="art_info_text">
						<?php echo the_field('additional_representation'); ?>
					</p>
				</div>
				<div class="col-md-6">

				</div>
			</div>

	
	<!-- #main -->
	</main>
</div>
</div>
</div>
</div>

<?php
get_footer();
