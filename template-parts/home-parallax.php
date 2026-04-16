<?php
/**
 * Template Part: Home — Parallax + Text Reveal
 */
$img = get_template_directory_uri() . '/assets/img/';

$lines = [
    __( 'Fragrances',    'isan-essencias' ),
    __( 'Personal Care', 'isan-essencias' ),
    __( 'House Hold',    'isan-essencias' ),
    __( 'Linha Pet',     'isan-essencias' ),
    __( 'Home Care',     'isan-essencias' ),
    __( 'Marketing Olfativo',     'isan-essencias' ),
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
    <?php foreach ( $lines as $line ) : ?>
      <a href="https://isanessencias.com/nossos-segmentos/" class="reveal-line" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $line ); ?></a>
    <?php endforeach; ?>
  </div>

</section>
