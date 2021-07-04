<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Stephen_Dinsmore
 */

?>
</div>
</div>
</div><!-- #page -->


<footer class="text-center text-lg-start text-muted">


    <section>
        <div class="container pt-5  text-center text-md-start mt-5">
            <div class="row mt-3 justify-content-between">
                <div class="footer_left_text_container col-md-8 col-lg-6 mb-4">
                    <p>
                        2303 Harrison Avenue <br>
                        Lincoln, Nebraska 68502 <br>
                        Cell: 402 730-3610 <br>
                    </p>
                    <p>(July thru September, studio in Maine: 207-733-2837)</p>
                    <p><a href="#">Privacy Policy</a> | ©2021</p>
                </div>
                <!-- <div class="col-md-4 col-lg-6 mb-4 footer_social">
					<div>
						<a href="#" class="mx-3 text-reset">
						<img class="align-self-start" src=<//?php echo ('"' . get_template_directory_uri() . '/images/Facebook_normal.png"') ?> alt="">
						</a>
						<a href="#" class="mx-3 text-reset">
						<img class="align-self-start" src=<//?php echo ('"' . get_template_directory_uri() . '/images/Instagram_normal.png"') ?> alt="">
						</a>
						<a href="#" class="mx-3 text-reset">
						<img class="align-self-start" src=<//?php echo ('"' . get_template_directory_uri() . '/images/Linkedin_normal.png"') ?> alt="">
						</a>

					</div> -->
            </div>

        </div>

        </div>
    </section>
</footer>


<?php wp_footer(); ?>
<script>
AOS.init();

jQuery(".row.grid.main_products_row.products li").addClass("grid-item");

setTimeout(() => {
    jQuery(document).ready(function() {

        if (jQuery(window).width() > 1000) {
            if (jQuery(window).scrollTop() + jQuery(window).height() <= jQuery(document).height()) {
                jQuery("footer").css({

                    "opacity": "1",
                    "bottom": "0",
                });
            } else if (jQuery(window).scrollTop() <= 1000) {
                jQuery("footer").css({
                    "opacity": "0",
                    "bottom": "-100%",
                });
            }
        }


        jQuery(window).scroll(function() {

            console.log(jQuery(window).scrollTop() + jQuery(window).height());
            if (jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document)
                .height()) {
                jQuery("footer").css({
                    "opacity": "1",
                    "bottom": "0",
                });

            } else if (jQuery(window).scrollTop() <= 1000) {
                jQuery("footer").css({
                    "opacity": "0",
                    "bottom": "-100%",
                });
            }
        });
    });


}, 800);
</script>
</body>

</html>