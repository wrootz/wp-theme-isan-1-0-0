<?php
/**
 * Template: Page (genérico — compatível com Elementor)
 *
 * O Elementor injeta seu conteúdo via the_content().
 * Este template é intencionalmente minimalista para não
 * interferir com os layouts criados no editor visual.
 */
get_header();
?>

<main id="main-content" class="site-main page-content" <?php post_class(); ?>>
  <?php
  while ( have_posts() ) :
      the_post();
      the_content();
  endwhile;
  ?>
</main>

<?php
get_footer();
