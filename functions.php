<?php
/**
 * Isan Essências — functions.php
 */

defined( 'ABSPATH' ) || exit;

/* ─── 1. THEME SETUP ─────────────────────────────────────── */
function isan_setup() {
    // Allow WordPress to manage the document title tag
    add_theme_support( 'title-tag' );

    // Thumbnail support
    add_theme_support( 'post-thumbnails' );

    // Custom logo
    add_theme_support( 'custom-logo', [
        'height'      => 80,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ] );

    // HTML5 markup
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list',
        'gallery', 'caption', 'style', 'script',
    ] );

    // Editor colour palette (matches CSS tokens)
    add_theme_support( 'editor-color-palette', [
        [ 'name' => 'Borgonha',    'slug' => 'primary',   'color' => '#47002a' ],
        [ 'name' => 'Fundo',       'slug' => 'bg',        'color' => '#faf9f7' ],
        [ 'name' => 'Fundo Alt',   'slug' => 'bg-alt',    'color' => '#f2ede7' ],
        [ 'name' => 'Texto',       'slug' => 'text',      'color' => '#1c1816' ],
        [ 'name' => 'Branco',      'slug' => 'white',     'color' => '#ffffff' ],
    ] );

    // Wide & full alignment blocks (Gutenberg / Elementor)
    add_theme_support( 'align-wide' );

    // Selective refresh for widgets
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Post Formats (exibe badge "VIDEO" nos cards)
    add_theme_support( 'post-formats', [ 'video', 'gallery', 'audio', 'quote', 'link' ] );

    // ── Nav menus ──────────────────────────────────────────
    register_nav_menus( [
        'nav-left'        => __( 'Header — Esquerda',     'isan-essencias' ),
        'nav-right'       => __( 'Header — Direita',      'isan-essencias' ),
        'footer-company'  => __( 'Footer — Company',      'isan-essencias' ),
        'footer-discover' => __( 'Footer — Discover',     'isan-essencias' ),
        'footer-learn'    => __( 'Footer — Learn',        'isan-essencias' ),
    ] );
}
add_action( 'after_setup_theme', 'isan_setup' );


/* ─── 2. ENQUEUE ASSETS ──────────────────────────────────── */
function isan_enqueue() {
    $ver = wp_get_theme()->get( 'Version' );
    $uri = get_template_directory_uri();

    // Main stylesheet
    wp_enqueue_style(
        'isan-main',
        $uri . '/assets/css/main.css',
        [],
        $ver
    );

    // Main script (deferred)
    wp_enqueue_script(
        'isan-main',
        $uri . '/assets/js/main.js',
        [],
        $ver,
        [ 'strategy' => 'defer', 'in_footer' => true ]
    );

    // Pass theme directory URI to JS
    wp_localize_script( 'isan-main', 'isanTheme', [
        'uri' => $uri,
    ] );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'isan_enqueue' );


/* ─── 3. ELEMENTOR COMPATIBILITY ────────────────────────── */
// Remove margin-top on Elementor pages so header overlay works
function isan_elementor_body_class( $classes ) {
    if ( class_exists( '\Elementor\Plugin' ) ) {
        $classes[] = 'elementor-active';
    }
    return $classes;
}
add_filter( 'body_class', 'isan_elementor_body_class' );

// Flush rewrite rules on theme activation
function isan_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'isan_rewrite_flush' );


/* ─── 4. WIDGET AREAS ────────────────────────────────────── */
function isan_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Sidebar Principal', 'isan-essencias' ),
        'id'            => 'sidebar-main',
        'description'   => __( 'Adicione widgets aqui.', 'isan-essencias' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] );
}
add_action( 'widgets_init', 'isan_widgets_init' );


/* ─── 5. EXCERPT LENGTH ──────────────────────────────────── */
function isan_excerpt_length() { return 18; }
add_filter( 'excerpt_length', 'isan_excerpt_length' );

function isan_excerpt_more() { return '&hellip;'; }
add_filter( 'excerpt_more', 'isan_excerpt_more' );


/* ─── 6. FLAT MENU WALKER ────────────────────────────────── */
/**
 * Renders nav menu items as bare <a> tags (no <ul><li> wrappers).
 * Used in header.php — must be defined before header.php loads.
 */
if ( ! class_exists( 'Isan_Flat_Walker' ) ) :
class Isan_Flat_Walker extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = implode( ' ', (array) $item->classes );
        $active  = in_array( 'current-menu-item', (array) $item->classes ) ? ' aria-current="page"' : '';
        $output .= sprintf(
            '<a href="%s" class="%s"%s>%s</a>',
            esc_url( $item->url ),
            esc_attr( $classes ),
            $active,
            esc_html( $item->title )
        );
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {}
}
endif;

/* ─── Fallback menus ─────────────────────────────────────── */
function isan_nav_left_fallback() { ?>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
  <a href="#">Sobre</a>
  <a href="#">Inovação</a>
  <a href="#">Conteúdos</a>
<?php }

function isan_nav_right_fallback() { ?>
  <button class="nav-search-btn" id="search-trigger" aria-label="<?php esc_attr_e( 'Abrir busca', 'isan-essencias' ); ?>" aria-expanded="false" aria-controls="search-overlay">Buscar</button>
  <a href="https://isanessencias.com/contato/" class="nav-cta">Contato</a>
<?php }

function isan_footer_company_fallback() { ?>
  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">Case Studies</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Method</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Contact</a></li>
  </ul>
<?php }

function isan_footer_discover_fallback() { ?>
  <ul>
    <li><a href="#">Programs</a></li>
    <li><a href="#">Speaking</a></li>
    <li><a href="#">VisionCamp&reg;</a></li>
    <li><a href="#">Our Book</a></li>
    <li><a href="#">Shop</a></li>
    <li><a href="#">Shows</a></li>
  </ul>
<?php }

function isan_footer_learn_fallback() { ?>
  <ul>
    <li><a href="#">Blog</a></li>
    <li><a href="#">Press &amp; Media</a></li>
    <li><a href="#">Testimonials</a></li>
    <li><a href="#">FAQs</a></li>
    <li><a href="#">Clients</a></li>
    <li><a href="#">Careers</a></li>
  </ul>
<?php }


/* ─── 7. META BOX: HERO VIDEO ───────────────────────────── */
/**
 * Adiciona um meta box na barra lateral do editor de páginas para
 * selecionar um vídeo MP4 da Biblioteca de Mídia como hero banner.
 * Usado pelo template "Página com Vídeo" (page-video.php).
 */
function isan_hero_video_meta_box() {
    add_meta_box(
        'isan_hero_video',
        __( 'Vídeo do Hero', 'isan-essencias' ),
        'isan_hero_video_render',
        'page',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'isan_hero_video_meta_box' );

function isan_hero_video_render( $post ) {
    wp_nonce_field( 'isan_hero_video_save', 'isan_hero_video_nonce' );
    $video_url = get_post_meta( $post->ID, '_isan_hero_video_url', true );
    ?>
    <p style="font-size:12px;color:#666;margin-bottom:8px;">
        <?php esc_html_e( 'Usado no template "Página com Vídeo". Envie um arquivo MP4 pela Biblioteca de Mídia.', 'isan-essencias' ); ?>
    </p>
    <input
        type="url"
        id="isan_hero_video_url"
        name="isan_hero_video_url"
        value="<?php echo esc_url( $video_url ); ?>"
        placeholder="https://..."
        style="width:100%;margin-bottom:6px;"
    >
    <button type="button" class="button button-secondary" id="isan-video-select" style="width:100%;text-align:center;">
        <?php esc_html_e( 'Escolher da Biblioteca de Mídia', 'isan-essencias' ); ?>
    </button>
    <?php if ( $video_url ) : ?>
        <video src="<?php echo esc_url( $video_url ); ?>"
               style="margin-top:10px;width:100%;border-radius:4px;display:block;"
               muted></video>
        <button type="button" class="button" id="isan-video-remove"
                style="margin-top:6px;width:100%;text-align:center;color:#b32d2e;">
            <?php esc_html_e( 'Remover vídeo', 'isan-essencias' ); ?>
        </button>
    <?php endif; ?>
    <script>
    jQuery( function( $ ) {
        var frame;
        $( '#isan-video-select' ).on( 'click', function( e ) {
            e.preventDefault();
            if ( frame ) { frame.open(); return; }
            frame = wp.media( {
                title:   '<?php echo esc_js( __( 'Selecionar Vídeo do Hero', 'isan-essencias' ) ); ?>',
                button:  { text: '<?php echo esc_js( __( 'Usar este vídeo', 'isan-essencias' ) ); ?>' },
                library: { type: 'video' },
                multiple: false
            } );
            frame.on( 'select', function() {
                var att = frame.state().get( 'selection' ).first().toJSON();
                $( '#isan_hero_video_url' ).val( att.url );
                /* Mostra preview sem precisar salvar */
                var preview = $( '#isan-video-preview' );
                if ( ! preview.length ) {
                    preview = $( '<video id="isan-video-preview" muted style="margin-top:10px;width:100%;border-radius:4px;display:block;"></video>' );
                    $( '#isan-video-select' ).after( preview );
                }
                preview.attr( 'src', att.url );
            } );
            frame.open();
        } );
        $( '#isan-video-remove' ).on( 'click', function() {
            $( '#isan_hero_video_url' ).val( '' );
            $( '#isan-video-preview' ).remove();
            $( this ).hide();
        } );
    } );
    </script>
    <?php
}

function isan_hero_video_save( $post_id ) {
    if ( ! isset( $_POST['isan_hero_video_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['isan_hero_video_nonce'], 'isan_hero_video_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    if ( isset( $_POST['isan_hero_video_url'] ) ) {
        update_post_meta( $post_id, '_isan_hero_video_url', esc_url_raw( $_POST['isan_hero_video_url'] ) );
    }
}
add_action( 'save_post', 'isan_hero_video_save' );

/* Garante que wp.media esteja disponível no editor de páginas */
function isan_hero_video_enqueue( $hook ) {
    if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) return;
    if ( isset( $_GET['post'] ) && 'page' !== get_post_type( (int) $_GET['post'] ) ) return;
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'isan_hero_video_enqueue' );


/* ─── 8. HELPER: SVG LOGO ────────────────────────────────── */
/**
 * Returns the inline SVG wordmark.
 * Used in header.php; keeps the logo tightly coupled to the theme.
 */
function isan_logo_svg() {
    return '<svg viewBox="0 0 495 361" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
        <path d="M0 358.6c2.7-1 3.3-3.4 3.3-9.3v-36.8c0-5.9-.6-8.4-3.3-9.3v-1.1h39.5l1 11.6-1.1.2c-3.3-8-8.5-10.5-17.7-10.5H12v24.7h8c10 0 12.9-2 14.2-6.2h1.1v13.8h-1.1c-1.3-4.3-4.2-6.3-14.3-6.3H12v25q.1 3.9 4.1 4h8c8.3 0 14-2.4 17-10.8l1.2.1-.6 12H0z" fill="currentColor"/>
        <path d="m56.6 354.7-.3-12.3 1-.2c3.5 9.4 10.8 16.6 21.8 16.6 5.7 0 11-3.6 11-10.3 0-8.1-10.7-11.9-17.3-14.5-8.5-3.6-15.6-6.4-15.6-16 0-10.1 8.3-16.5 21.2-16.5q9.3.1 15.8 3.5l.3 10.7-.9.3a19.5 19.5 0 0 0-18.3-13c-6.6 0-11.8 3.8-11.8 10.3 0 7.3 8.3 10.3 14.9 13 8.4 3.1 18.4 6.8 18.4 16.7 0 11.3-10.4 17.6-19.9 17.6a36 36 0 0 1-20.3-5.9" fill="currentColor"/>
        <path d="m110.4 354.7-.4-12.3 1.1-.2c3.5 9.4 10.8 16.6 21.8 16.6 5.6 0 11-3.6 11-10.3 0-8.1-10.7-11.9-17.3-14.5-8.5-3.6-15.6-6.4-15.6-16 0-10.1 8.3-16.5 21.2-16.5q9.2.1 15.8 3.5l.3 10.7-.9.3a19.5 19.5 0 0 0-18.3-13c-6.6 0-11.8 3.8-11.8 10.3 0 7.3 8.3 10.3 14.9 13 8.4 3.1 18.4 6.8 18.4 16.7 0 11.3-10.4 17.6-19.9 17.6a36 36 0 0 1-20.3-5.9" fill="currentColor"/>
        <path d="M164.8 358.6c2.8-1 3.3-3.4 3.3-9.3v-36.8c0-5.9-.6-8.4-3.3-9.3v-1.1h39.6l.9 11.6-1 .2c-3.4-8-8.6-10.5-17.8-10.5h-9.6v24.7h7.9c10 0 12.9-2 14.2-6.2h1.2v13.8H199c-1.3-4.3-4.2-6.3-14.2-6.3h-8v25q0 3.9 4.2 4h7.9c8.3 0 14-2.4 17.1-10.8l1 .1-.5 12h-41.7zm10.9-61.1 9-9.8h.5l9.5 9.6-.7.7-9-3.8-8.7 3.8z" fill="currentColor"/>
        <path d="M226.9 311.6v32.7c0 10 2 13 6.2 14.3v1.1h-11v-1.1c2.7-1 3.3-3.4 3.3-9.3v-36.8c0-5.9-.8-8.4-4.3-9.3v-1.1h9.3l34.6 43.3v-27.9c0-10-2-13-6.3-14.3v-1.1H270v1.1c-2.8 1-3.3 3.4-3.3 9.4v47.8h-1.1z" fill="currentColor"/>
        <path d="M285.4 331.9c0-16.6 13.2-30.4 33.4-30.4 6 0 14.6 1.2 18.8 4l.4 11-1 .2a22 22 0 0 0-20.4-13.6c-13.1 0-22.4 8.7-22.4 25.1s9.4 30.6 25.4 30.6c9.2 0 15.6-5.6 18.5-14.1l1.1.1-1.3 11.8a48 48 0 0 1-20.7 4c-19.7 0-31.8-10.3-31.8-28.7" fill="currentColor"/>
        <path d="M355 358.6c2.7-1 3.2-3.4 3.2-9.3v-36.8c0-5.9-.5-8.4-3.2-9.3v-1.1h15.3v1.1c-2.7 1-3.3 3.4-3.3 9.3v36.8c0 6 .6 8.4 3.3 9.3v1.1h-15.4z" fill="currentColor"/>
        <path d="M380.7 358.6c2.4-1 4.6-3 6.9-8.6l15.4-38.2a5 5 0 0 0-.2-4.5l-1-2.3 8-3.6 20.4 48.7c2.3 5.4 4.5 7.6 6.4 8.5v1.1h-15v-1.1c2.7-1 1.5-3-.8-8.5l-4.9-11.9h-22l-4.8 11.8c-2.2 5.5-1.7 8 1.1 8.6v1.1h-9.6zm34.6-21.7-10.6-25.4-10.3 25.4z" fill="currentColor"/>
        <path d="m445.9 354.7-.3-12.3 1-.2c3.5 9.4 10.8 16.6 21.8 16.6 5.7 0 11-3.6 11-10.3 0-8.1-10.7-11.9-17.3-14.5-8.5-3.6-15.6-6.4-15.6-16 0-10.1 8.3-16.5 21.2-16.5q9.3.1 15.8 3.5l.4 10.7-1 .3a19.5 19.5 0 0 0-18.3-13c-6.6 0-11.8 3.8-11.8 10.3 0 7.3 8.3 10.3 14.9 13 8.4 3.1 18.4 6.8 18.4 16.7 0 11.3-10.4 17.6-19.9 17.6a36 36 0 0 1-20.3-5.9" fill="currentColor"/>
        <path d="M5.2 241.7q0-1 1-1.5c7-2.9 8.6-10.2 8.6-26.7V106.8c0-16.5-1.6-23.8-8.6-26.7q-1-.4-1-1.5v-.5q.2-1.6 1.7-1.7H48q1.6.2 1.7 1.7v.5q0 1.1-1 1.5c-7 3-8.6 10.2-8.6 26.7v106.7c0 16.5 1.6 23.8 8.6 26.7q1 .5 1 1.5v.6q-.1 1.5-1.7 1.6H7q-1.6-.1-1.7-1.6z" fill="currentColor"/>
        <path d="m70.3 228.5-1-33.6q.2-1.4 1.5-1.7h.3q1.3-.2 1.8 1c10.3 26.7 31.4 47.1 62.7 47.1 16.5 0 31.9-10.5 31.9-30.2 0-23.4-31-34.4-50-42-24.7-10.4-45.3-18.5-45.3-46.3 0-29.6 24-48 61.5-48 17.3 0 32.8 3.6 45 9.5q1 .5 1 1.5l.9 28.9q0 1.2-1.1 1.6-1.5.5-2.1-1a56 56 0 0 0-52.8-36.5c-19.1 0-34.2 11.3-34.2 30.2 0 21.3 24.2 29.9 43.3 37.5 24.4 9.4 53.4 20.1 53.4 48.9 0 32.7-30.2 51-57.7 51-24.2 0-46.1-7.7-58.4-16.6q-.7-.5-.7-1.3" fill="currentColor"/>
        <path d="M372.9 108c-1-1.3-3-.6-3 1v90.2c0 28.3 5.4 37 17 41q1.1.4 1.2 1.6v.5q-.2 1.5-1.7 1.6h-28.7q-1.6-.1-1.7-1.6v-.6q0-1 1-1.5c7-2.9 8.6-10.2 8.6-26.7V106.8c0-16.5-2-23.8-11.2-26.7q-1.1-.4-1.2-1.6v-.4q.1-1.6 1.6-1.7h24.6q.8 0 1.3.6l97 121.6c1 1.2 3 .5 3-1v-76.4c0-28.3-5.4-37-17-41q-1.1-.6-1.2-1.6V78q.2-1.6 1.7-1.7h29q1.5.2 1.6 1.7v.5q0 1.1-1 1.5c-7 3-8.6 10.2-8.6 26.7v137.4q-.1 1.5-1.6 1.6h-.7q-.8 0-1.3-.6z" fill="currentColor"/>
        <path d="M330 216 271.3 76a1.7 1.7 0 0 0-2.3-.8l-20.3 9.1q-1.4.8-.8 2.3l2.4 5.1c2.1 4.3 2.3 8.2.4 13l-44.7 111c-6.2 15.2-12.3 21.6-19 24.5q-1 .4-1.1 1.5v.6q.1 1.5 1.7 1.6H212q1.5-.1 1.6-1.6v-.5q0-1.1-1-1.5c-7.2-2.3-8.2-9.3-2-24.6l8.8-22 6.5-16 28.3-70.3a1.7 1.7 0 0 1 3.1 0l31 74 14.4 34.5c6.4 15.1 9.7 21.5 3.1 24.3q-1 .5-1 1.5v.6q.2 1.5 1.7 1.6h40.2q1.6-.1 1.7-1.6v-.7q0-1-.9-1.5c-5.2-2.8-11.2-9.2-17.6-24.2" fill="currentColor"/>
        <path d="M304.7 50.6a64 64 0 0 1 22 47.4 50 50 0 0 1-13.9 35.6q-5.7 6.3-12.6 11.4l2.2 5.2q5.3-4 10.1-8.5a59 59 0 0 0 19.4-36.4c1-8.1-.2-16.4-2.3-24.2q-3.9-14.6-13.4-26.2c-14.9-18-37.2-29-58.8-36.8A340.8 340.8 0 0 0 91.2 4.7q-17.8 3-35 8.6-14.1 4.5-26.8 12.3c-6.2 4-12.3 9.1-15.9 15.7q-2.4 4.5-3 9.5c-.3 3.3-.1 7.6 2.4 10 3.6 3.4 9.2 3.4 12.6 7.1 2.4 2.6 6.2-1.2 3.9-3.8a19 19 0 0 0-7-4.5c-1.8-.8-4.2-1.4-5.6-2.6s-1-5.5-.6-7.2a27 27 0 0 1 10-15 82 82 0 0 1 22-12.7q15.4-6.2 31.8-9.7c26.1-5.7 53.2-7.6 80-6.7 27.5 1 55.1 5 81.6 13 22.4 6.6 45.5 16 63 32" fill="currentColor"/>
        <path d="m279 159-1.1.7c-13.6 8.1-27.6 15.7-40.6 25q-12.2 8.5-22.1 19.5l-4.7 11.5q-2.8 7.2-3.7 12a85 85 0 0 1 27-33.7c12.7-10 27-18 40.8-26l6.4-3.9z" fill="currentColor"/>
        <path d="M26.7 70.3a16 16 0 1 0 0-32.2 16 16 0 0 0 0 32.2" fill="currentColor"/>
    </svg>';
}


/* ─── 8. CF7 CONTACT FORM: CNPJ REGEX VALIDATION ────────────────────────────────── */

// Validação de CNPJ para Contact Form 7
add_filter('wpcf7_validate_text*', 'custom_cnpj_validation', 20, 2);
add_filter('wpcf7_validate_text', 'custom_cnpj_validation', 20, 2);

function custom_cnpj_validation($result, $tag) {
    if ($tag->name == 'cnpj') {
        $cnpj = isset($_POST['cnpj']) ? $_POST['cnpj'] : '';
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj); // Remove pontuação

        if (!valida_cnpj($cnpj)) {
            $result->invalidate($tag, "CNPJ inválido. Por favor, verifique os números.");
        }
    }
    return $result;
}

// Função lógica para cálculo de CNPJ
function valida_cnpj($cnpj) {
    if (strlen($cnpj) != 14) return false;
    if (preg_match('/(\d)\1{13}/', $cnpj)) return false; // Elimina sequências repetidas como 000...

    for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) return false;

    for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
        $soma += $cnpj[$i] * $j;
        $j = ($j == 2) ? 9 : $j - 1;
    }
    $resto = $soma % 11;
    return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
}