<?php
/**
 * Template: 404
 */
get_header();
?>

<main id="main-content" class="site-main" style="min-height:70vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:4rem 2rem;">
  <div>
    <p class="label-sm"><?php esc_html_e( 'Erro 404', 'isan-essencias' ); ?></p>
    <h1 class="hero__title" style="font-size:clamp(2rem,5vw,4rem);margin-bottom:1.5rem;">
      <?php esc_html_e( 'Página não encontrada', 'isan-essencias' ); ?>
    </h1>
    <p style="color:var(--text-muted);margin-bottom:2rem;max-width:420px;margin-inline:auto;">
      <?php esc_html_e( 'A página que procura não existe ou foi movida.', 'isan-essencias' ); ?>
    </p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-pill">
      <?php esc_html_e( '← Voltar ao início', 'isan-essencias' ); ?>
    </a>
  </div>
</main>

<?php get_footer(); ?>
