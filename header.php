<!DOCTYPE html>
<html <?php language_attributes(); ?> class="theme-light">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ═══ HEADER ═══════════════════════════════════════════════ -->
<header class="header" id="header">
  <div class="header__inner">

    <!-- Nav esquerda -->
    <nav class="nav-left" aria-label="<?php esc_attr_e( 'Menu principal', 'isan-essencias' ); ?>">
      <?php
      wp_nav_menu( [
          'theme_location' => 'nav-left',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'walker'         => new Isan_Flat_Walker(),
          'fallback_cb'    => 'isan_nav_left_fallback',
      ] );
      ?>
    </nav>

    <!-- Logo centralizado -->
    <div class="logo-wrap">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
         aria-label="<?php bloginfo( 'name' ); ?> — <?php esc_attr_e( 'Página inicial', 'isan-essencias' ); ?>">
        <?php
        if ( has_custom_logo() ) {
            the_custom_logo();
        } else {
            echo isan_logo_svg(); // inline SVG fallback (functions.php)
        }
        ?>
      </a>
    </div>

    <!-- Nav direita -->
    <nav class="nav-right" aria-label="<?php esc_attr_e( 'Menu secundário', 'isan-essencias' ); ?>">
      <?php
      wp_nav_menu( [
          'theme_location' => 'nav-right',
          'container'      => false,
          'items_wrap'     => '%3$s',
          'walker'         => new Isan_Flat_Walker(),
          'fallback_cb'    => 'isan_nav_right_fallback',
      ] );
      ?>
    </nav>

    <!-- Hamburger (mobile) -->
    <button class="hamburger" id="hamburger"
            aria-label="<?php esc_attr_e( 'Abrir menu', 'isan-essencias' ); ?>"
            aria-expanded="false"
            aria-controls="mobile-menu">
      <span></span><span></span><span></span>
    </button>

  </div>
</header>

<!-- Mobile menu -->
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">

  <!-- Botão fechar -->
  <button class="mobile-menu__close" id="mobile-close" aria-label="<?php esc_attr_e( 'Fechar menu', 'isan-essencias' ); ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
  </button>

  <!-- Links de navegação -->
  <?php
  wp_nav_menu( [
      'theme_location' => 'nav-left',
      'container'      => false,
      'items_wrap'     => '%3$s',
      'walker'         => new Isan_Flat_Walker(),
      'fallback_cb'    => '__return_false',
  ] );
  wp_nav_menu( [
      'theme_location' => 'nav-right',
      'container'      => false,
      'items_wrap'     => '%3$s',
      'walker'         => new Isan_Flat_Walker(),
      'fallback_cb'    => '__return_false',
  ] );
  ?>

  <!-- Rodapé do menu: redes sociais + WhatsApp -->
  <div class="mobile-menu__footer">
    <a href="https://www.instagram.com/isanessencias" class="mobile-menu__social" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
      <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 3h4.4q1 0 2 .4a4 4 0 0 1 2.2 2.1q.3 1 .3 2a81 81 0 0 1-.3 11 4 4 0 0 1-2.1 2q-1 .4-2 .4a81 81 0 0 1-11-.3 4 4 0 0 1-2-2.1q-.5-1-.5-2a81 81 0 0 1 .4-11 4 4 0 0 1 2.1-2q1-.5 2-.5zm0-2H7.5Q6 1 4.8 1.7a6 6 0 0 0-3.2 3.2Q1 6.1 1 7.5L1 12v4.5q0 1.5.6 2.7a6 6 0 0 0 3.2 3.2q1.3.5 2.7.5l4.5.1h4.5q1.5 0 2.7-.6a6 6 0 0 0 3.2-3.2q.5-1.3.5-2.7L23 12V7.5q0-1.4-.6-2.7a6 6 0 0 0-3.2-3.2Q17.9 1 16.5 1zm0 14.7a4 4 0 0 1-3.4-2.3 3.7 3.7 0 1 1 3.4 2.3m5.9-8.2a1.3 1.3 0 1 0 0-2.7 1.3 1.3 0 0 0 0 2.7"/></svg>
    </a>
    <a href="https://www.linkedin.com/in/isan-ess%C3%AAncias-e-aromas-ltda-6a4487179/?originalSubdomain=br" class="mobile-menu__social" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
      <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23 0H1Q0 0 0 1v22q0 1 1 1h22q1 0 1-1V1q0-1-1-1M7.1 20.5H3.6V9h3.6v11.5zM5.3 7.4c-1.1 0-2.1-.9-2.1-2.1 0-1.1.9-2.1 2.1-2.1 1.1 0 2.1.9 2.1 2.1a2 2 0 0 1-2.1 2.1m15.2 13.1h-3.6v-5.6c0-1.3 0-3-1.8-3S13 13.3 13 14.8v5.7H9.4V9h3.4v1.6c.5-.9 1.6-1.8 3.4-1.8 3.6 0 4.3 2.4 4.3 5.5z"/></svg>
    </a>
    <a href="https://wa.me/5511992486368?text=Ol%C3%A1!%20Estava%20no%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es" class="mobile-menu__social mobile-menu__social--wa" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
      <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
    </a>
  </div>

</div>

<!-- Walker & fallbacks defined in functions.php -->

<!-- ═══ SEARCH OVERLAY ══════════════════════════════════════ -->
<div class="search-overlay" id="search-overlay" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Buscar no site', 'isan-essencias' ); ?>" aria-hidden="true">
  <button class="search-overlay__close" id="search-close" aria-label="<?php esc_attr_e( 'Fechar busca', 'isan-essencias' ); ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M18 6 6 18M6 6l12 12"/></svg>
  </button>
  <form class="search-overlay__form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input
      type="search"
      name="s"
      class="search-overlay__input"
      placeholder="<?php esc_attr_e( 'O que você procura?', 'isan-essencias' ); ?>"
      autocomplete="off"
      aria-label="<?php esc_attr_e( 'Buscar no site', 'isan-essencias' ); ?>"
      value="<?php echo esc_attr( get_search_query() ); ?>"
    >
    <button type="submit" class="search-overlay__submit" aria-label="<?php esc_attr_e( 'Buscar', 'isan-essencias' ); ?>">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
    </button>
  </form>
</div>
