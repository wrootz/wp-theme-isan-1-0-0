<?php
/**
 * Template: Front Page (Home)
 * Layout proprietário — hero, slider numerado, parallax, blog.
 */
get_header();
$img = get_template_directory_uri() . '/assets/img/';
?>

<!-- ═══ HERO ═══════════════════════════════════════════════ -->
<?php get_template_part( 'template-parts/home', 'hero' ); ?>

<!-- ═══ SLIDER NUMERADO ════════════════════════════════════ -->
<?php get_template_part( 'template-parts/home', 'slider' ); ?>

<!-- ═══ PARALLAX + TEXT REVEAL ════════════════════════════ -->
<?php get_template_part( 'template-parts/home', 'parallax' ); ?>

<!-- ═══ BLOG ═══════════════════════════════════════════════ -->
<?php get_template_part( 'template-parts/home', 'blog' ); ?>

<?php get_footer(); ?>
