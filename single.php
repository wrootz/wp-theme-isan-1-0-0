<?php
/**
 * Template: Single Post
 */
get_header();
?>

<main id="main-content" class="site-main single-post">
  <div class="single-post__wrap">

    <?php while ( have_posts() ) : the_post(); ?>

      <article <?php post_class(); ?>>

        <!-- Meta -->
        <header class="single-post__header">
          <span class="label-sm"><?php the_category( ', ' ); ?></span>
          <h1 class="page-body__title"><?php the_title(); ?></h1>
        </header>

        <!-- Thumbnail (oculta em posts do formato Vídeo) -->
        <?php if ( has_post_thumbnail() && ! has_post_format( 'video' ) ) : ?>
          <figure class="single-post__thumb">
            <?php the_post_thumbnail( 'large' ); ?>
          </figure>
        <?php endif; ?>

        <!-- Content -->
        <div class="entry-content">
          <?php the_content(); ?>
        </div>

        <!-- Navigation -->
        <nav class="single-post__nav">
          <?php
          previous_post_link( '<span>← %link</span>' );
          next_post_link( '<span>%link →</span>' );
          ?>
        </nav>

      </article>

      <?php 
        // comments_template();
      ?>

    <?php endwhile; ?>

  </div>
</main>

<?php get_footer(); ?>
