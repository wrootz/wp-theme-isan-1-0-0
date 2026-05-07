<?php
/**
 * Template Part: Home — Parallax + Text Reveal
 */
$img = get_template_directory_uri() . '/assets/img/';

$base = trailingslashit( site_url( '/nossos-segmentos/' ) );

$lines = [
    __( 'Fragrances',         'isan-essencias' ) => $base . '#FineFragrances',
    __( 'Personal Care',      'isan-essencias' ) => $base . '#PersonalCare',
    __( 'House Hold',         'isan-essencias' ) => $base . '#HomeCare',
    __( 'Linha Pet',          'isan-essencias' ) => $base . '#PetCare',
    __( 'Home Care',          'isan-essencias' ) => $base . '#HomeCare',
    __( 'Marketing Olfativo', 'isan-essencias' ) => $base . '#MarketingOlfativo',
];
?>
<section class="parallax-section" id="sobre" aria-label="<?php esc_attr_e( 'Categorias de produtos', 'isan-essencias' ); ?>">

  <div class="parallax-bg" id="parallax-bg">
    <picture>
      <source srcset="<?php echo esc_url( $img . 'imgi_73_home-fragrancias-slide-02.avif' ); ?>" type="image/avif">
      <img
        src="<?php echo esc_url( $img . 'imgi_52_home-slider-2.webp' ); ?>"
        alt=""
        aria-hidden="true"
        loading="eager"
        draggable="false"
      >
    </picture>
  </div>

  <div class="parallax-overlay"></div>

  <div class="parallax-content" id="reveal-wrap">
    <?php foreach ( $lines as $label => $url ) : ?>

      <a href="<?php echo esc_url( $url ); ?>" class="reveal-line">
        <?php echo esc_html( $label ); ?>
      </a>
      
    <?php endforeach; ?>
  </div>

</section>
