<?php
/**
 * Template Part: Home — Numbered Slider
 */
$img = get_template_directory_uri() . '/assets/img/';

$slides = [
    [
        'title'  => __( 'Cada essência é formulada com paixão, cuidado e um olhar atento às tendências', 'isan-essencias' ),
        'body'   => __( 'Criamos fragrâncias exclusivas para perfumaria, cosméticos, aromatizantes e produtos para pets. Combinamos tecnologia e criatividade para desenvolver composições olfativas que evocam memórias e sensações.', 'isan-essencias' ),
        'img'    => $img . 'imgi_52_home-slider-2.webp',
        'img_alt'=> __( 'Sérum Âmbar — fragrância amadeirada sobre madeira', 'isan-essencias' ),
    ],
    [
        'title'  => __( 'Inspirados pela natureza, criamos experiências sensoriais únicas', 'isan-essencias' ),
        'body'   => __( 'Nossas fragrâncias nascem de ingredientes botanicamente selecionados, harmonizando notas florais, cítricas e amadeiradas que celebram a biodiversidade e o cuidado com o meio ambiente.', 'isan-essencias' ),
        'img'    => $img . 'imgi_59_home-slider-1.jpg',
        'img_alt'=> __( 'Magnólia Rosa — fragrância floral intensa', 'isan-essencias' ),
    ],
    [
        'title'  => __( 'Fragrâncias que criam conexão e emoção em cada momento', 'isan-essencias' ),
        'body'   => __( 'Acreditamos no poder do aroma como linguagem afetiva — capaz de fortalecer vínculos, evocar memórias e transformar momentos cotidianos em experiências extraordinárias.', 'isan-essencias' ),
        'img'    => $img . 'imgi_66_home-slider-3.jpg',
        'img_alt'=> __( 'Conexão humana — bem-estar e afeto', 'isan-essencias' ),
    ],
];
?>
<section class="slider-section" id="inovacao" aria-label="<?php esc_attr_e( 'Inovação em fragrâncias', 'isan-essencias' ); ?>">
  <div class="container">

    <!-- Tabs numéricas -->
    <div class="slider-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Selecionar fragrância', 'isan-essencias' ); ?>">
      <?php foreach ( $slides as $i => $slide ) : ?>
        <button
          class="slider-tab <?php echo $i === 0 ? 'active' : ''; ?>"
          role="tab"
          aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
          data-slide="<?php echo esc_attr( $i ); ?>"
        ><?php echo esc_html( $i + 1 ); ?></button>
      <?php endforeach; ?>
    </div>

    <!-- Painéis -->
    <?php foreach ( $slides as $i => $slide ) : ?>
      <div
        class="slider-panel <?php echo $i === 0 ? 'active' : ''; ?>"
        role="tabpanel"
        data-panel="<?php echo esc_attr( $i ); ?>"
        <?php echo $i !== 0 ? 'hidden' : ''; ?>
      >
        <div class="slider-panel__text">
          <h2 class="slider-panel__title"><?php echo esc_html( $slide['title'] ); ?></h2>
          <p  class="slider-panel__body"><?php echo esc_html( $slide['body'] ); ?></p>
          <a href="https://isanessencias.com/nossos-segmentos/" class="btn-pill"><?php esc_html_e( 'Saiba mais', 'isan-essencias' ); ?></a>
        </div>
        <div class="slider-panel__img">
          <img
            src="<?php echo esc_url( $slide['img'] ); ?>"
            alt="<?php echo esc_attr( $slide['img_alt'] ); ?>"
            loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"
          >
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</section>
