<?php
  $redux_ThemeTek = get_option( 'redux_ThemeTek' );
  $title_align_class = $single_page_title_align = $values = $titlebar_bg = $shop_titlebar_bg = $shop_title_bar_text_align = '';

  $blog_title = get_the_title( get_option('page_for_posts', true) );
  $keydesign_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_option('page_for_posts')), 'full', false );

  if (is_home() && is_front_page()) {
    $blog_title = get_bloginfo();
    $description = get_bloginfo( 'description', 'display' );
  }

  $themetek_page_subtitle = get_post_meta( get_the_ID(), '_themetek_page_subtitle', true );
  $themetek_page_showhide_title_section = get_post_meta( get_the_ID(), '_themetek_page_showhide_title_section', true );
  $themetek_page_showhide_breadcrumbs = get_post_meta( get_the_ID(), '_themetek_page_showhide_breadcrumbs', true );
  $themetek_page_title_color = get_post_meta( get_the_ID(), '_themetek_page_title_color', true );
  $themetek_page_title_subtitle_color = ' color:'.$themetek_page_title_color;
  $themetek_page_titlebar_background = get_post_meta( get_the_ID(), '_themetek_page_titlebar_background', true );
  $themetek_post_id = get_the_ID();
  $themetek_header_image = wp_get_attachment_image_src( get_post_thumbnail_id($themetek_post_id), 'full', false );

  if ( class_exists( 'WooCommerce' ) && is_post_type_archive( 'product' ) ) {
    $shop_page_id = wc_get_page_id( 'shop' );
    /* Shop page title color */
    $shop_page_title_color = get_post_meta( $shop_page_id, '_themetek_page_title_color', true );
    $shop_title_color = 'color:'.$shop_page_title_color;

    /* Shop page title align */
    $values = get_post_custom( $shop_page_id );
    $shop_page_title_align = isset( $values['page_title_align'] ) ? esc_attr( $values['page_title_align'][0] ) : '';
    if ( $shop_page_title_align == "left-align" ) {
      $shop_title_bar_text_align = 'blog-title-left';
    } elseif ( $shop_page_title_align == "center-align" ) {
      $shop_title_bar_text_align = 'blog-title-center';
    } elseif ( $shop_page_title_align == "right-align" ) {
      $shop_title_bar_text_align = 'blog-title-right';
    }

    /* Shop page header image */
    $shop_page_header_image = wp_get_attachment_image_src( get_post_thumbnail_id($shop_page_id), 'full', false );

    /* Shop page title bar background color */
    $shop_page_titlebar_background = get_post_meta( $shop_page_id, '_themetek_page_titlebar_background', true );
    if ($shop_page_titlebar_background != '') {
      $shop_titlebar_bg = $shop_page_titlebar_background;
    }

    /* Shop page show/hide title */
    $shop_page_showhide_title_section = get_post_meta( $shop_page_id, '_themetek_page_showhide_title_section', true );

    /* Shop page show/hide breadcrumbs */
    $shop_page_showhide_breadcrumbs = get_post_meta( $shop_page_id, '_themetek_page_showhide_breadcrumbs', true );

    /* Shop page subtitle */
    $shop_page_subtitle = get_post_meta( $shop_page_id, '_themetek_page_subtitle', true );
  }

  /* Single Page title bar background color */
  if ($themetek_page_titlebar_background != '') {
    $titlebar_bg = $themetek_page_titlebar_background;
  }

  if (!is_404()) {
    $values = get_post_custom( get_the_ID() );
    $keydesign_page_title_align = isset( $values['page_title_align'] ) ? esc_attr( $values['page_title_align'][0] ) : '';
    if ( $keydesign_page_title_align == "left-align" ) {
      $single_page_title_align = 'blog-title-left';
    } elseif ( $keydesign_page_title_align == "center-align" ) {
      $single_page_title_align = 'blog-title-center';
    } elseif ( $keydesign_page_title_align == "right-align" ) {
      $single_page_title_align = 'blog-title-right';
    }
  }

  if (isset($redux_ThemeTek['tek-blog-header-text-align']) && $redux_ThemeTek['tek-blog-header-text-align'] != '') {
    $title_align_class = $redux_ThemeTek['tek-blog-header-text-align'];
  }

  if (!isset($redux_ThemeTek['tek-blog-single-sidebar'])) {
    $redux_ThemeTek['tek-blog-single-sidebar'] = 1;
  }

  if (is_single() && $redux_ThemeTek['tek-blog-single-sidebar'] == 0) {
    $title_align_class = 'blog-title-center';
  } elseif (is_single() && $redux_ThemeTek['tek-blog-single-sidebar'] == 1) {
    $title_align_class = 'blog-title-left';
  }
?>


<?php if ( class_exists( 'bbPress' ) && is_bbpress() ) : ?>
   <header class="entry-header blog-header bbpress-header">
      <div class="container">
      <h2 class="section-heading">
        <?php the_title(); ?>
      </h2>
      <div class="bbpress-breadcrumbs"></div>
      </div>
    </header>

<?php elseif (class_exists( 'WooCommerce' ) && is_woocommerce()) : ?>
  <?php if ( empty($shop_page_showhide_title_section)) : ?>
    <header class="entry-header blog-header <?php if (isset($redux_ThemeTek['tek-topbar'])) { if ($redux_ThemeTek['tek-topbar'] == '1') { echo esc_attr('with-topbar'); }} ?>" <?php if ($shop_titlebar_bg != '') { echo 'style="background-color: '.$shop_titlebar_bg.';"'; } ?>>
        <div class="row blog-page-heading <?php if (is_shop()) { echo esc_attr($shop_title_bar_text_align); } ?>">
          <?php if ( is_shop() && $shop_page_header_image != '' ) : ?>
            <div class="header-overlay parallax-overlay" style="background-image:url('<?php echo esc_url($shop_page_header_image[0]); ?>')"></div>
          <?php endif; ?>
          <div class="container">
            <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
              <h1 class="section-heading" <?php if (!empty($shop_title_color)) : ?> style="<?php echo esc_attr($shop_title_color); ?>" <?php endif; ?>><?php woocommerce_page_title(); ?></h1>
              <?php do_action( 'woocommerce_archive_description' ); ?>
            <?php endif; ?>
            <?php if (is_shop() && $shop_page_subtitle != '') : ?>
              <p class="section-subheading" <?php if (!empty($shop_title_color)) : ?> style="<?php echo esc_attr($shop_title_color); ?>" <?php endif; ?>><?php echo esc_html($shop_page_subtitle); ?></p>
            <?php endif; ?>
            <?php if(function_exists('bcn_display') && empty($shop_page_showhide_breadcrumbs)) : ?>
              <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/" <?php if (!empty($shop_title_color)) : ?> style="<?php echo esc_attr($shop_title_color); ?>" <?php endif; ?>>
                <?php bcn_display(); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
    </header>
  <?php endif; ?>

<?php elseif(is_home() || is_search() || is_archive() || is_single() && !is_singular( 'portfolio' )) : ?>
  <header class="entry-header blog-header <?php if (isset($redux_ThemeTek['tek-topbar'])) { if ($redux_ThemeTek['tek-topbar'] == '1') { echo esc_attr('with-topbar'); }} ?>">
     <div class="row blog-page-heading <?php echo esc_attr($title_align_class); ?>">
        <?php if (!is_single()) : ?>
          <?php if (isset($redux_ThemeTek['tek-blog-header-template']) && $redux_ThemeTek['tek-blog-header-template'] == 'blog-header-titlebar') : ?>
            <div class="header-overlay parallax-overlay" style="background-image:url('<?php echo esc_url($keydesign_header_image[0]); ?>')"></div>
          <?php endif; ?>
        <?php endif; ?>
        <div class="container">
          <?php if( is_home() ) : ?>
            <?php if (isset($redux_ThemeTek['tek-blog-title-switch']) && $redux_ThemeTek['tek-blog-title-switch'] != '0') : ?>
              <h1 class="section-heading"><?php echo esc_html($blog_title); ?></h1>
            <?php else: ?>
              <h1 class="section-heading"><?php echo esc_html($blog_title); ?></h1>
              <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
          <?php elseif ( is_search() ) : ?>
            <h1 class="section-heading">
               <?php echo apply_filters( 'kd_search_query_title', esc_html__("Search results for", "ekko") ); ?>: <?php the_search_query();  ?>
            </h1>
          <?php elseif ( is_category() ) : ?>
            <h1 class="section-heading">
               <?php echo apply_filters( 'kd_single_cat_title', esc_html__("Currently browsing", "ekko") ); ?>: <?php single_cat_title(); ?>
            </h1>
          <?php elseif ( is_tag() ) : ?>
            <h1 class="section-heading">
               <?php echo apply_filters( 'kd_single_tag_title', esc_html__("All posts tagged", "ekko") ); ?>: <?php single_tag_title(); ?>
            </h1>
          <?php elseif ( is_author() ) : ?>
            <h1 class="section-heading">
               <?php echo apply_filters( 'kd_author_archive_title', esc_html__("All posts by", "ekko") ); ?> <?php echo esc_html(get_userdata(get_query_var('author'))->display_name); ?>
            </h1>
          <?php elseif ( is_day() ) : ?>
            <h1 class="section-heading">
               <?php echo apply_filters( 'kd_day_archive_title', esc_html__("Posts archive for", "ekko") ); ?> <?php echo get_the_date('F jS, Y'); ?>
            </h1>
          <?php elseif ( is_month() ) : ?>
            <h1 class="section-heading">
               <?php echo apply_filters( 'kd_month_archive_title', esc_html__("Posts archive for", "ekko") ); ?> <?php echo get_the_date('F, Y'); ?>
            </h1>
          <?php elseif ( is_year() ) : ?>
            <h1 class="section-heading">
              <?php echo apply_filters( 'kd_year_archive_title', esc_html__("Posts archive for", "ekko") ); ?> <?php echo get_the_date('Y'); ?>
            </h1>
          <?php elseif ( get_page( get_option('page_for_posts') ) && !is_single() ) : ?>
            <h1 class="section-heading">
              <?php echo apply_filters('the_title',get_page( get_option('page_for_posts') )->post_title); ?>
            </h1>
          <?php elseif (!is_single()) : ?>
            <h1 class="section-heading"><?php echo esc_html(get_the_title(get_queried_object_id())); ?></h1>
          <?php endif; ?>

          <?php if (isset($redux_ThemeTek['tek-blog-subtitle']) && ($redux_ThemeTek['tek-blog-subtitle'] != '') && is_home() ) : ?>
            <p class="section-subheading"><?php echo esc_html($redux_ThemeTek['tek-blog-subtitle']); ?></p>
          <?php endif; ?>

          <?php if(function_exists('bcn_display')) : ?>
            <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php bcn_display(); ?>
            </div>
          <?php endif; ?>

          <?php if (isset($redux_ThemeTek['tek-blog-header-form']) && is_home()) : ?>
            <?php if( !empty($redux_ThemeTek['tek-blog-header-form-id']) && $redux_ThemeTek['tek-blog-header-form'] == 1 ) : ?>
              <div class="blog-header-form">
                <?php echo do_shortcode('[contact-form-7 id="'. esc_attr($redux_ThemeTek['tek-blog-header-form-id']).'"]'); ?>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
  </header>
<?php elseif(!is_404() && !is_singular( 'portfolio' )) : ?>
  <?php if ( empty($themetek_page_showhide_title_section) && !is_single()) : ?>
    <header class="entry-header single-page-header <?php if (isset($redux_ThemeTek['tek-topbar'])) { if ($redux_ThemeTek['tek-topbar'] == '1') { echo esc_attr('with-topbar'); }} ?>" <?php if ($titlebar_bg != '') { echo 'style="background-color: '.$titlebar_bg.';"'; } ?>>
      <div class="row single-page-heading <?php echo esc_attr($single_page_title_align); ?>">
        <?php if (!empty($themetek_header_image) && !is_single()) : ?>
          <div class="header-overlay parallax-overlay" style="background-image:url('<?php echo esc_url($themetek_header_image[0]); ?>')"></div>
        <?php endif; ?>
          <div class="container">
            <h1 class="section-heading" <?php if (!empty($themetek_page_title_color)) : ?> style="<?php echo esc_attr($themetek_page_title_subtitle_color); ?>" <?php endif; ?>><?php the_title(); ?></h1>
            <?php if (($themetek_page_subtitle) && !is_single()) : ?>
              <p class="section-subheading" <?php if (!empty($themetek_page_title_color)) : ?> style="<?php echo esc_attr($themetek_page_title_subtitle_color); ?>" <?php endif; ?>><?php echo esc_html($themetek_page_subtitle); ?></p>
            <?php endif; ?>
            <?php if(function_exists('bcn_display') && empty($themetek_page_showhide_breadcrumbs)) : ?>
              <div <?php echo (!empty($themetek_page_title_color) ? 'style="color: '.$themetek_page_title_color.';"' : ''); ?> class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display(); ?>
              </div>
            <?php endif; ?>
        </div>
      </div>
    </header>
  <?php endif; ?>
<?php elseif(is_singular( 'portfolio' )) : ?>
  <?php if ( empty($themetek_page_showhide_title_section)) : ?>
    <header class="entry-header single-page-header <?php if (isset($redux_ThemeTek['tek-topbar'])) { if ($redux_ThemeTek['tek-topbar'] == '1') { echo esc_attr('with-topbar'); }} ?>" <?php if ($titlebar_bg != '') { echo 'style="background-color: '.$titlebar_bg.';"'; } ?>>
      <div class="row single-page-heading <?php echo esc_attr($single_page_title_align); ?>">
          <div class="container">
            <h1 class="section-heading" <?php if (!empty($themetek_page_title_color)) : ?> style="<?php echo esc_attr($themetek_page_title_subtitle_color); ?>" <?php endif; ?>><?php the_title(); ?></h1>
            <?php if (($themetek_page_subtitle)) : ?>
              <p class="section-subheading" <?php if (!empty($themetek_page_title_color)) : ?> style="<?php echo esc_attr($themetek_page_title_subtitle_color); ?>" <?php endif; ?>><?php echo esc_html($themetek_page_subtitle); ?></p>
            <?php endif; ?>
            <?php if(function_exists('bcn_display')) : ?>
              <div <?php echo (!empty($themetek_page_title_color) ? 'style="color: '.$themetek_page_title_color.';"' : ''); ?> class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display(); ?>
              </div>
            <?php endif; ?>
        </div>
      </div>
    </header>
  <?php endif; ?>
<?php endif; ?>
