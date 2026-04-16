<?php
/**
 * Template Name: Página Interna
 * Template Post Type: page
 *
 * Template para páginas de conteúdo: Sobre Nós, Serviços, Segmentos, etc.
 *
 * COMO TROCAR A IMAGEM DO HERO:
 *   No editor de cada página → barra lateral direita
 *   → "Imagem Destacada" → defina a foto desejada.
 *   Se nenhuma imagem for definida, usa-se a imagem padrão do hero da home.
 */
get_header();

// ── Hero: Imagem Destacada da página (Featured Image) ─────
$post_id  = get_queried_object_id();
$hero_url = has_post_thumbnail( $post_id )
    ? get_the_post_thumbnail_url( $post_id, 'full' )
    : get_template_directory_uri() . '/assets/img/imgi_45_home-hero-desktop.png';
?>

<main id="main-content" class="site-main">

  <!-- ═══ PAGE HERO ════════════════════════════════════════ -->
   
  <section class="page-hero">
    <div class="page-hero__bg"
         style="background-image:url('<?php echo esc_url( $hero_url ); ?>')"
         role="img"
         aria-label="<?php the_title_attribute(); ?>">
    </div>
    <div class="page-hero__overlay" aria-hidden="true"></div>
  </section>

  <!-- ═══ CONTEÚDO ═════════════════════════════════════════ -->

  <?php while ( have_posts() ) : the_post(); ?>

  <article id="page-<?php the_ID(); ?>" <?php post_class( 'page-body' ); ?>>
    <div class="page-body__inner">

      <!-- Título da página — fonte serifada (Kaftan) -->
      <h1 class="page-body__title"><?php the_title(); ?></h1>

      <!-- Conteúdo editado no WordPress -->
      <div class="entry-content">
        <?php the_content(); ?>
      </div>

    </div>
  </article>

  <?php endwhile; ?>

</main>

<?php get_footer(); ?>
