<?php
/**
 * Template Part: Home — Hero
 */
$img = get_template_directory_uri() . '/assets/img/';
?>
<section class="hero" id="inicio" aria-label="<?php esc_attr_e( 'Hero principal', 'isan-essencias' ); ?>">
  <div class="hero__bg" id="hero-bg"></div>
  <div class="hero__content">
    <h1 class="hero__title">
      <?php esc_html_e( 'Transformando ideias em', 'isan-essencias' ); ?><br>
      <?php esc_html_e( 'fragrâncias inspiradoras', 'isan-essencias' ); ?>
    </h1>
    <div class="hero__actions">
      <a href="https://isanessencias.com/sobre-nos/" class="btn-pill"><?php esc_html_e( 'Saiba mais', 'isan-essencias' ); ?></a>
      <a href="https://wa.me/5511992486368?text=Ol%C3%A1!%20Estava%20no%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es" class="btn-pill btn-pill--ghost" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Entre em contato', 'isan-essencias' ); ?></a>
    </div>
  </div>
</section>
