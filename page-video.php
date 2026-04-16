<?php
/**
 * Template Name: Página com Vídeo
 * Template Post Type: page
 *
 * Template para páginas com banner em vídeo MP4 ao fundo.
 *
 * COMO CONFIGURAR:
 *   1. No editor da página → barra lateral direita
 *      → painel "Vídeo do Hero" → clique em "Escolher da Biblioteca de Mídia"
 *      → faça upload ou selecione um arquivo MP4 → clique "Usar este vídeo".
 *   2. Salve/publique a página.
 *   3. Se nenhum vídeo for definido, usa a Imagem Destacada como fallback.
 *      Se nem imagem houver, usa a imagem padrão do hero da home.
 */
get_header();

$post_id   = get_queried_object_id();
$video_url = get_post_meta( $post_id, '_isan_hero_video_url', true );

// Fallback: Imagem Destacada → imagem padrão da home
$fallback_img = has_post_thumbnail( $post_id )
    ? get_the_post_thumbnail_url( $post_id, 'full' )
    : get_template_directory_uri() . '/assets/img/imgi_45_home-hero-desktop.png';
?>

<main id="main-content" class="site-main">

  <!-- ═══ PAGE HERO ════════════════════════════════════════ -->
  <section class="page-hero">

    <?php if ( $video_url ) : ?>
      <video
        class="page-hero__video"
        src="<?php echo esc_url( $video_url ); ?>"
        autoplay
        muted
        loop
        playsinline
        aria-hidden="true"
        preload="auto"
      ></video>
    <?php else : ?>
      <div class="page-hero__bg"
           style="background-image:url('<?php echo esc_url( $fallback_img ); ?>')"
           role="img"
           aria-label="<?php the_title_attribute(); ?>">
      </div>
    <?php endif; ?>

    <div class="page-hero__overlay" aria-hidden="true"></div>

  </section>

  <!-- ═══ CONTEÚDO ═════════════════════════════════════════ -->
  <?php while ( have_posts() ) : the_post(); ?>

  <article id="page-<?php the_ID(); ?>" <?php post_class( 'page-body' ); ?>>
    <div class="page-body__inner">

      <h1 class="page-body__title"><?php the_title(); ?></h1>

      <div class="entry-content">
        <?php the_content(); ?>
      </div>

    </div>
  </article>

  <?php endwhile; ?>

</main>

<?php get_footer(); ?>
