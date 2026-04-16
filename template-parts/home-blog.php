<?php
/**
 * Template Part: Home — Blog (3 posts recentes)
 */
$img   = get_template_directory_uri() . '/assets/img/';

// Fallback images if post has no thumbnail
$fallbacks = [
    $img . 'imgi_77_home-blog-fragrancias-01.avif',
    $img . 'imgi_84_home-blog-fragrancias-02.avif',
    $img . 'imgi_73_home-fragrancias-slide-02.avif',
];

$query = new WP_Query( [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
] );
?>
<section class="blog-section" id="blog" aria-label="<?php esc_attr_e( 'Últimos artigos do blog', 'isan-essencias' ); ?>">
  <div class="container">

    <div class="blog-header">
      <div>
        <span class="label-sm"><?php esc_html_e( 'Blog', 'isan-essencias' ); ?></span>
        <p class="blog-header__title"><?php esc_html_e( 'Mais Recentes', 'isan-essencias' ); ?></p>
      </div>
      <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog' ) ); ?>"
         class="link-arrow">
        <?php esc_html_e( 'Ver tudo →', 'isan-essencias' ); ?>
      </a>
    </div>

    <div class="blog-grid">
      <?php
      if ( $query->have_posts() ) :
        $count = 0;
        while ( $query->have_posts() ) :
          $query->the_post();
          $thumb = has_post_thumbnail()
            ? get_the_post_thumbnail_url( null, 'large' )
            : $fallbacks[ $count % 3 ];
          ?>
          <a href="<?php the_permalink(); ?>" class="blog-card">
            <div class="blog-card__img">
              <?php if ( has_post_format( 'video' ) ) : ?>
                <span class="blog-card__badge">
                  <svg viewBox="0 0 10 12" fill="currentColor" aria-hidden="true"><path d="M0 0l10 6-10 6z"/></svg>
                  VIDEO
                </span>
              <?php endif; ?>
              <img
                src="<?php echo esc_url( $thumb ); ?>"
                alt="<?php the_title_attribute(); ?>"
                loading="lazy"
              >
              <div class="blog-card__overlay">
                <p class="blog-card__title-img"><?php the_title(); ?></p>
                <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 14, '…' ); ?></p>
              </div>
            </div>
          </a>
          <?php
          $count++;
        endwhile;
        wp_reset_postdata();

      else :
        /* Sem posts — mostra placeholders estáticos */
        $placeholders = [
            [ 'img' => $img . 'imgi_77_home-blog-fragrancias-01.avif', 'fallback' => $img . 'imgi_59_home-slider-1.jpg', 'title' => 'What is Lorem Ipsum' ],
            [ 'img' => $img . 'imgi_84_home-blog-fragrancias-02.avif', 'fallback' => $img . 'imgi_52_home-slider-2.webp', 'title' => 'What is Lorem Ipsum' ],
            [ 'img' => $img . 'imgi_73_home-fragrancias-slide-02.avif','fallback' => $img . 'imgi_66_home-slider-3.jpg',   'title' => 'What is Lorem Ipsum' ],
        ];
        foreach ( $placeholders as $ph ) : ?>
          <a href="#" class="blog-card">
            <div class="blog-card__img">
              <picture>
                <source srcset="<?php echo esc_url( $ph['img'] ); ?>" type="image/avif">
                <img src="<?php echo esc_url( $ph['fallback'] ); ?>" alt="" loading="lazy">
              </picture>
              <div class="blog-card__overlay">
                <p class="blog-card__title-img"><?php echo esc_html( $ph['title'] ); ?></p>
                <p class="blog-card__excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.</p>
              </div>
            </div>
          </a>
        <?php endforeach;
      endif;
      ?>
    </div><!-- /.blog-grid -->

  </div>
</section>
