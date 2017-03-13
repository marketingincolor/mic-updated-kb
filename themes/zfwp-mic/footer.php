<?php
/**
 * The footer template
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>
<!--    <div class="gtm-box">-->

        <!-- Google Code for Remarketing Tag -->
<!--         Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup 
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 1058809171;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1058809171/?value=0&guid=ON&script=0"/>
        </div>
        </noscript>-->
<!--    </div>-->
    <!--VimeoScript-->
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://www.marketingincolor.com/vimeo.ga.js" type="text/javascript"></script>-->
    <!--/VimeoScript-->
    </body>
<!--end Google Code-->
	<div class="bgnd-silver contain-to-grid">
        <div class="row large-collapse">
            <footer id="colophon" class="site-footer small-12 columns hide-for-small-down" role="contentinfo">
                <br />
                <div class="row collapse medium-uncollapse large-uncollapse">
                    <div class="footer-box small-12 medium-4 columns hide-for-medium-only">
                        <?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
                            <div id="widget-area" class="widget-area NOTcolumns" role="complementary">
                                <?php dynamic_sidebar( 'sidebar-4' ); ?>
                            </div><!-- .widget-area -->
                        <?php endif; ?>
                        <div class="show-for-small-only"><hr class="footer-rule" /></div>
                    </div>
                    <div class="footer-box footer-separator small-12 medium-4 columns">
                        <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
                            <div id="widget-area" class="widget-area NOTcolumns" role="complementary">
                                <?php dynamic_sidebar( 'sidebar-5' ); ?>
                            </div><!-- .widget-area -->
                        <?php else : ?>
                        <div id="widget-area" class="widget-area NOTcolumns" role="complementary">
                            <div class="widget">
                                <h3 class="widget-title">Marketing In Color</h3>
                                <div class="widget-details">
                                    <a href="tel:<?php do_action( 'co_phone' ); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-ftr-ico-ph.png">
                                    <?php do_action( 'co_phone' ); ?></a>
                                </div>
                                <div class="widget-details">
                                    <a href="mailto:<?php do_action( 'co_email' ); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-ftr-ico-em.png">
                                    <?php do_action( 'co_email' ); ?></a>
                                </div>
                                <div class="widget-details">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-ftr-ico-ad.png">
                                    <a href="https://www.google.com/maps/place/1515+N+Marion+St,+Tampa,+FL+33602/@27.9581507,-82.4597758,18z/data=!4m7!1m4!3m3!1s0x88c2c46153ac8083:0x3e70fe559f047bce!2s1515+N+Marion+St,+Tampa,+FL+33602!3b1!3m1!1s0x88c2c4615329056f:0xc4b3eef492826fc9!6m1!1e1" target="_new"><?php do_action( 'co_address' ); ?></a>
                                </div>

                                <div class="widget-details">
                                    <a href="http://marketingincolor.com/sharpspring-login/">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/SharpSpring Footer Icon.png" alt="SharpSpring Icon">
                                    <?php do_action( 'co_sharpspring' ); ?></a>
                                </div>

                            </div>
                        </div><!-- .widget-area -->
                        <?php endif; ?>
                        <span class="show-for-small-only"><hr class="footer-rule" /></span>
                    </div>
                    <div class="footer-box footer-separator small-12 medium-4 columns">
                        <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
                            <div id="widget-area" class="hide-for-small-only widget-area NOTcolumns" role="complementary">
                                <?php dynamic_sidebar( 'sidebar-6' ); ?>
                            </div><!-- .widget-area -->
                        <?php endif; ?>
                    </div>
                </div>
                <br />
                <div class="row collapse medium-uncollapse large-uncollapse site-info">
                    <div id="footer-menu" class="small-12 columns">
                        <div class="footer-nav">
                            <div class="footer-copy">
                                <a href="<?php echo esc_url( home_url( '/privacy' ) ); ?>">Privacy Policy</a>
                            </div>
                            <div class="footer-copy">&nbsp;&#124;&nbsp;</div>
                            <div class="footer-copy">
                                &copy; <?php echo date("Y"); ?> Marketing In Color
                            </div>
                        </div>
                    </div>
                </div><!-- .site-info -->

            </footer><!-- .site-footer -->
	</div>
	</div>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.topbar.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.equalizer.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.dropdown.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.accordion.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/slick/slick.min.js"></script>
<script>
	$(document).foundation();
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.frontpage-wwd-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			autoplay: true,
			autoplaySpeed: 6000
		});
	});
	jQuery(function($){
		$('.brgr-ico').click( function(){
			var $pos = $('.stick-left').css('left');
			if ($pos == '0px') {
				$('.stick-left').css('left','-92%');
			} else {
				$('.stick-left').css('left','0px');
			}
		})
	})
</script>


</html>
