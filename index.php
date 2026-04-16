<?php
/**
 * Template: Index / Blog
 * Usado como fallback e como página de listagem de posts.
 */
get_header();
?>

<main id="main-content" class="site-main blog-index">
  <div class="container" style="padding-top:calc(var(--nav-h) + 4rem); padding-bottom:6rem;">

    <div style="margin-bottom:2.5rem;">
      <span class="label-sm">Blog</span>
      <h1 class="section-title" style="font-family:var(--serif);">
        <?php
        if ( is_home() && ! is_front_page() ) {
            single_post_title();
        } elseif ( is_archive() ) {
            the_archive_title();
        } else {
            esc_html_e( 'Artigos', 'isan-essencias' );
        }
        ?>
      </h1>
    </div>

    <?php if ( have_posts() ) : ?>
      <div class="blog-grid">
        <?php
        while ( have_posts() ) :
            the_post();
            $thumb = has_post_thumbnail()
                ? get_the_post_thumbnail_url( null, 'large' )
                : get_template_directory_uri() . '/assets/img/imgi_59_home-slider-1.jpg';
        ?>
          <a href="<?php the_permalink(); ?>" class="blog-card">
            <div class="blog-card__img">
              <?php if ( has_post_format( 'video' ) ) : ?>
                <span class="blog-card__badge">
                  <svg viewBox="0 0 10 12" fill="currentColor" aria-hidden="true"><path d="M0 0l10 6-10 6z"/></svg>
                  VIDEO
                </span>
              <?php endif; ?>
              <img src="<?php echo esc_url( $thumb ); ?>"
                   alt="<?php the_title_attribute(); ?>"
                   loading="lazy">
              <div class="blog-card__overlay">
                <p class="blog-card__title-img"><?php the_title(); ?></p>
                <p class="blog-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 14, '…' ); ?></p>
              </div>
            </div>
          </a>
        <?php endwhile; ?>
      </div>

      <div style="margin-top:3rem; text-align:center;">
        <?php the_posts_pagination( [ 'mid_size' => 2 ] ); ?>
      </div>

    <?php else : ?>
      <p><?php esc_html_e( 'Nenhum artigo encontrado.', 'isan-essencias' ); ?></p>
    <?php endif; ?>

  </div>
</main>

<?php get_footer(); ?>
