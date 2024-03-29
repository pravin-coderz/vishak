<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #wrapper div and all content after.
 *
 * @package ekko
 * by KeyDesign
 */

 $redux_ThemeTek = get_option( 'redux_ThemeTek' );
 $footer_wrapper_class = $footer_fixed_class = $link_hover_effect = $footer_active_widgets = '';

 $footer_active_widgets = is_active_sidebar( 'footer-first-widget-area' ) + is_active_sidebar( 'footer-second-widget-area' ) + is_active_sidebar( 'footer-third-widget-area' ) + is_active_sidebar( 'footer-fourth-widget-area' );

 if (isset($redux_ThemeTek['tek-footer-fixed'])) {
   if ($redux_ThemeTek['tek-footer-fixed'] == '1') {
     $footer_fixed_class ='fixed';
   } else {
     $footer_fixed_class ='classic';
   }
 }

 if (isset($redux_ThemeTek['tek-footer-link-hover-effect']) && $redux_ThemeTek['tek-footer-link-hover-effect'] != '' ) {
   $link_hover_effect = $redux_ThemeTek['tek-footer-link-hover-effect'];
 } else {
   $link_hover_effect = 'default-footer-link-effect';
 }

 $footer_wrapper_class = implode(' ', array($footer_fixed_class, $link_hover_effect));
?>

</div>
<footer id="footer" class="<?php echo esc_attr( $footer_wrapper_class ); ?>">
  <div class="upper-footer">
    <div class="container">
      <?php if( isset($redux_ThemeTek['tek-footer-bar']) && $redux_ThemeTek['tek-footer-bar'] == 1 ) : ?>
        <div class="footer-bar">
          <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
            <div class="footer-nav-menu">
              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'navbar-footer', 'fallback_cb' => 'false' ) ); ?>
            </div>
          <?php endif; ?>
          <?php if( class_exists( 'ReduxFramework' ) ) : ?>
            <div class="footer-socials-bar">
                <?php echo do_shortcode('[social_profiles]'); ?>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
      <?php if( $footer_active_widgets >= "1" ) : ?>
        <div class="footer-widget-area">
          <?php get_sidebar( 'footer' ); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="lower-footer">
    <div class="container">
       <span>
         <?php if (isset($redux_ThemeTek['tek-footer-text'])) {
           echo wp_specialchars_decode(esc_html($redux_ThemeTek['tek-footer-text']));
         } else {
           echo esc_html('Ekko by KeyDesign. All rights reserved.');
         } ?>
       </span>
   </div>
  </div>
</footer>
<?php /* Back to top button template */ ?>
<?php if (isset($redux_ThemeTek['tek-backtotop']) && $redux_ThemeTek['tek-backtotop'] == "1") : ?>
    <div class="back-to-top">
       <i class="fa fa-angle-up"></i>
    </div>
<?php endif; ?>
<?php /* END Back to top button template */ ?>

<?php /* Modal Box template */ ?>
<?php if (isset($redux_ThemeTek['tek-modal-button'])) : ?>
  <?php if ($redux_ThemeTek['tek-modal-button'] && ($redux_ThemeTek['tek-header-button-action'] == '1')) : ?>
    <?php get_template_part( 'core/templates/header/content', 'modal-box' ); ?>
  <?php endif; ?>
<?php endif; ?>
<?php /* END Modal Box template */ ?>

<?php /* Side Panel template */ ?>
<?php if (isset($redux_ThemeTek['tek-panel-button'])) : ?>
  <?php if ($redux_ThemeTek['tek-panel-button'] && ($redux_ThemeTek['tek-panel-button-action'] == '1')) : ?>
    <?php get_template_part( 'core/templates/header/content', 'side-panel' ); ?>
  <?php endif; ?>
<?php endif; ?>
<?php /* END Side Panel template */ ?>

<?php wp_footer(); ?>
</body>
</html>
