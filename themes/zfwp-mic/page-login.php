<?php
/**
 * The template for displaying pages, with NO sidebar
 *
 * This is the template that displays all pages by default, the standard template.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */

get_header(); ?>
<div class="row collapse medium-uncollapse">
	<div class="small-10 small-offset-1 columns">
<div id="main-content"><!--classSmall12Columns-->
    <section class="scroll-container" role="main">
        <div class="small-12 medium-6 medium-offset-3 columns">
        <div id="mic-kb-container-login">
        <?php
        if ( ! is_user_logged_in() ) { // Display WordPress login form:
            $args = array(
                'redirect' => admin_url(), 
                'form_id' => 'mic-custom-login',
                'label_username' => __( '' ),
                'label_password' => __( '' ),
                'label_remember' => __( 'Remember Me' ),
                'label_log_in' => __( 'Log In' ),
                'remember' => true
            );
            echo '<p class="text-center">Have an account? Sign In.</p>';
            wp_login_form( $args );
        } else { // If logged in:
            wp_loginout( home_url() ); // Display "Log Out" link.
            echo " | ";
            wp_register('', ''); // Display "Site Admin" link.
        }
        ?>
        </div>
        </div>
    </section>
</div>
    </div>
</div>

<?php get_footer(); ?>