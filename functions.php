<?php

/**
 * Stephen Dinsmore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Stephen_Dinsmore
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('stephen_dinsmore_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function stephen_dinsmore_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Stephen Dinsmore, use a find and replace
		 * to change 'stephen-dinsmore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('stephen-dinsmore', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'stephen-dinsmore'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'stephen_dinsmore_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'stephen_dinsmore_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function stephen_dinsmore_content_width()
{
	$GLOBALS['content_width'] = apply_filters('stephen_dinsmore_content_width', 640);
}
add_action('after_setup_theme', 'stephen_dinsmore_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function stephen_dinsmore_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'stephen-dinsmore'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'stephen-dinsmore'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'stephen_dinsmore_widgets_init');

/**
 * Enqueue scripts and styles.
 */

function stephen_dinsmore_scripts()
{
	wp_enqueue_style('bootstrap5', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css');
	wp_enqueue_style('fontawesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css');
	wp_enqueue_style('aosCss', 'https://unpkg.com/aos@2.3.1/dist/aos.css');
	wp_enqueue_style('stephen-dinsmore-style', get_stylesheet_uri(), array(), rand(111,9999));
	wp_style_add_data('stephen-dinsmore-style', 'rtl', 'replace');
	wp_enqueue_script('stephen-dinsmore-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('masonry', get_template_directory_uri() . '/js/masonry.js');
	wp_enqueue_script('bootstrapBundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js');
	wp_enqueue_script('aosJs', 'https://unpkg.com/aos@2.3.1/dist/aos.js');
	wp_enqueue_script('fontawesomeCDN', 'https://use.fontawesome.com/9ee8149ce1.js');

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}


add_action('wp_enqueue_scripts', 'stephen_dinsmore_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Change Out of Stock Text
 */
add_filter('woocommerce_get_availability', 'availability_filter_func');
function availability_filter_func($availability)
{
$availability['availability'] = str_ireplace('Out of stock', 'SOLD', $availability['availability']);
return $availability;
}


remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

add_action('woocommerce_single_product_summary', 'customizing_single_product_summary_hooks', 2);
function customizing_single_product_summary_hooks()
{
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
	remove_action('woocommerce_single_product_summary', 'WC_Structured_Data::generate_product_data()', 60);
}

add_action('woocommerce_single_product_summary', 'customizing_single_product_summary_title_display', 2);
function customizing_single_product_summary_title_display()
{
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
}

add_action('woocommerce_single_product_summary', 'customizing_single_product_summary_shortdesc_display', 2);
function customizing_single_product_summary_shortdesc_display()
{
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
}

//Separating Register Form

function add_the_items_before_title()
{
?>
<div class="row breadcrumb-container pb-5 justify-content-center align-items-center">
    <div class="col-md-6">
        <?php
			/**
			 * woocommerce_before_main_content hook.
			 *
			 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
			 * @hooked woocommerce_breadcrumb - 20
			 */
			do_action('woocommerce_before_main_content');
			?>
    </div>
    <div class="col-md-6">
        <?php
			get_product_search_form();
			?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h1 class="mt-0"><?php the_title(); ?> </h1>
    </div>
</div>
<?php
}


function already_have_an_account_text(){
	?>

<span class="log_in_text mt-4 d-block">
    Do you already have an account? <b><a
            href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') );  ?>">Log in</a></b>
</span>


<?php
}

add_action('woocommerce_before_customer_login_form', 'add_the_items_before_title', 20);


add_shortcode('wc_separate_register_form', 'separate_registration_form');
function separate_registration_form(){
	if (is_admin()) {
		return;
	}
	if (is_user_logged_in()) {
		return;
	}
	ob_start();


	do_action('woocommerce_before_customer_login_form');

?>
<form method="post" class="custom_sign_in_form woocommerce-form woocommerce-form-register register"
    <?php do_action('woocommerce_register_form_tag'); ?>>

    <div class="row mb-4 mt-4 register_form_fields_container">
        <?php do_action('woocommerce_register_form_start'); ?>

        <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

        <div class="col-12 col-lg-6 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_username"><b><?php esc_html_e('Username', 'woocommerce'); ?> <span
                        class="required">*</span></b></label>
            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                id="reg_username" autocomplete="username"
                value="<?php echo (!empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" />
        </div>

        <?php endif; ?>

        <div class="col-12 col-lg-6 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_email"><b><?php esc_html_e('Email address', 'woocommerce'); ?> <span
                        class="required">*</span></b></label>
            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text"
                placeholder="Your Email Address" name="email" id="reg_email" autocomplete="email"
                value="<?php echo (!empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" />
        </div>
    </div>

    <div class="row mb-4 register_form_fields_container">
        <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>

        <div class="col-12 col-lg-6 woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
            <label for="reg_password"><b><?php esc_html_e('Password', 'woocommerce'); ?> <span
                        class="required">*</span></b></label>
            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Password"
                name="password" id="reg_password" autocomplete="new-password" />
        </div>

        <?php else : ?>

        <p><?php esc_html_e('A password will be sent to your email address.', 'woocommerce'); ?></p>

        <?php endif; ?>

        <?php 
				 
				 do_action('woocommerce_register_form');
				 
				 ?>

    </div>


    <div class="row">
        <div class="col-12  woocommerce-FormRow form-row">
            <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
            <button type="submit"
                class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit sign_up_button"
                name="register"
                value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Create New Account', 'woocommerce'); ?>
                <img class="ml-1" src=<?php echo( '"'.get_template_directory_uri().'/images/continue_arrow.png"' )?>
                    alt="">
            </button>
        </div>
    </div>
    <?php add_action('woocommerce_register_form_end', 'already_have_an_account_text'); ?>
    <?php do_action('woocommerce_register_form_end'); ?>

</form>

<?php

	return ob_get_clean();
}


//Extended Woocommerce Form Fields

add_action('woocommerce_register_form_start', 'woocom_extra_register_fields');
function woocom_extra_register_fields()
{ ?>

<div class='col-12 col-lg-6 form-row form-row-wide'>

    <label for='reg_billing_first_name'><b><?php _e('First name', 'woocommerce'); ?><span
                class='required'>*</span></b></label>
    <input type='text' class='input-text' placeholder="Your Name" name='billing_first_name' id='reg_billing_first_name'
        value='<?php if (!empty($_POST['billing_first_name'])) esc_attr_e($_POST['billing_first_name']); ?>' />
</div>
<!--p class='form-row form-row-wide'>
		<label for='reg_billing_last_name'><?php // _e('Last name', 'woocommerce');
											?>
		<span class='required'>*</span>
		</label>
		<input type='text' class='input-text' name='billing_last_name' id='reg_billing_last_name' value='<?php // if (!empty($_POST['billing_last_name'])) esc_attr_e($_POST['billing_last_name']);
																											?>' />
	</p -->

<?php

}

add_action('woocommerce_register_form', 'wc_register_form_password_repeat');
function wc_register_form_password_repeat()
{
?>
<div class="col-12 col-lg-6 form-row form-row-wide">
    <label for="reg_password2"><b><?php _e('Confirm Password', 'woocommerce'); ?> <span
                class="required">*</span></b></label>
    <input type="password" class="input-text" placeholder="Confirm Password" name="password2" id="reg_password2"
        value="<?php if (!empty($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
</div>
<?php
}

// Validating Fields
add_action('woocommerce_register_post', 'woocom_validate_extra_register_fields', 10, 3);
function woocom_validate_extra_register_fields($username, $email, $validation_errors)
{
	if (isset($_POST['billing_first_name']) && empty($_POST['billing_first_name'])) {
		$validation_errors->add('billing_first_name_error', __('First Name is required!', 'woocommerce'));
	}
	/*
	if (isset($_POST['billing_last_name']) && empty($_POST['billing_last_name'])) {
		$validation_errors->add('billing_last_name_error', __('Last Name is required!', 'woocommerce'));
	}
	return $validation_errors;
	*/
}



// Saving Field Values in Database
add_action('woocommerce_created_customer', 'woocom_save_extra_register_fields');
function woocom_save_extra_register_fields($customer_id)
{
	if (isset($_POST['billing_first_name'])) {
		update_user_meta($customer_id, 'billing_first_name', sanitize_text_field($_POST['billing_first_name']));
	}
	/*
	if (isset($_POST['billing_last_name'])) {
		update_user_meta($customer_id, 'billing_last_name', sanitize_text_field($_POST['billing_last_name']));
	}
	*/
}
	




/*
#Custom Fields For Wordpress Register
add_action('register_form', 'wedevs_registration_form');
function wedevs_registration_form()
{
?>
<p>
    <label for="first_name">
        <?php esc_html_e('First Name', 'first_name') ?> <br />
        <input type="text" class="regular_text" name="first_name" />
    </label>
</p>
<p>
    <label for="last_name">
        <?php esc_html_e('Last Name', 'last_name') ?> <br />
        <input type="text" class="regular_text" name="last_name" />
    </label>
</p>
<p>
    <label for="bio">
        <?php esc_html_e('Acerca de mi', 'description') ?> <br />
        <input type="text" class="regular_text" name="description" />
    </label>
</p>
<?php
}


// Field validation
add_filter('registration_errors', 'wedevs_registration_errors', 10, 3);
function wedevs_registration_errors($errors, $sanitized_user_login, $user_email)
{

	if (empty($_POST['first_name'])) {
		$errors->add('first', __('<strong>ERROR</strong>: First is missing', 'wedevs'));
	}
	if (empty($_POST['last_name'] || $_POST['bio'])) {
		$errors->add('last', __('<strong>ERROR</strong>: Last name is missing', 'wedevs'));
	}
	if (empty($_POST['description'])) {
		$errors->add('bio', __('<strong>ERROR</strong>: Bio is missing', 'wedevs'));
	}

	return $errors;
}

add_action('user_register', 'wedevs_save_data');

function wedevs_save_data($user_id)
{
	if (!empty($_POST['first_name'])) {
		update_user_meta($user_id, 'first_name', trim($_POST['first_name']));
	}

	if (!empty($_POST['last_name'])) {
		update_user_meta($user_id, 'last_name', trim($_POST['last_name']));
	}

	if (!empty($_POST['description'])) {
		update_user_meta($user_id, 'bio', trim($_POST['bio']));
	}
}
*/

add_action('woocommerce_before_shop_loop_item_title', function(){
global $product;

if (!is_product_category()) {
    ?>

	<div class="category_badge text-uppercase">

		<?php
         
         $product_dump = $product->get_categories(', ', '<span class="posted_in">' . _n('', '', sizeof(get_the_terms($post->ID, 'product_cat')), 'woocommerce') . ' ', '</span>');
    $main_cat = list($firstWord) = explode(',', $product_dump);
    echo $main_cat[0]; ?>

	</div>

<?php
}
});


add_action( 'woocommerce_after_shop_loop_item_title',function(){
	global $product;
	?>


	
		<span class="mx-2"> | </span>
	 <h2>  <?php echo $product->get_dimensions(); ?></h2>


<?php
});

function woocommerce_template_loop_category_title( $category ) { 
    ?>
<div class="custom_title_container d-flex align-items-baseline">
		<div class="category_main_text">
            <h2>
			<?php 
            echo $category->name; 
 
            if ( $category->count > 0 ) 
                echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category ); 
        ?>
			</h2>
	</div>
 
</div>
<?php 
} 