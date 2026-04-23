<!-- ═══ FOOTER ═════════════════════════════════════════════ -->
<footer class="footer" id="contato">

  <div class="footer__grid">

    <!-- Col 1: Company -->
    <div class="footer__col">
      <span class="footer__col-title"><?php esc_html_e( 'ISAN', 'isan-essencias' ); ?></span>
      <?php
      wp_nav_menu( [
          'theme_location' => 'footer-company',
          'container'      => 'ul',
          'fallback_cb'    => 'isan_footer_company_fallback',
      ] );
      ?>
    </div>

    <!-- Col 2: Discover -->
    <div class="footer__col">
      <span class="footer__col-title"><?php esc_html_e( 'SOLUÇÕES', 'isan-essencias' ); ?></span>
      <?php
      wp_nav_menu( [
          'theme_location' => 'footer-discover',
          'container'      => 'ul',
          'fallback_cb'    => 'isan_footer_discover_fallback',
      ] );
      ?>
    </div>

    <!-- Col 3: Learn -->
    <div class="footer__col">
      <span class="footer__col-title"><?php esc_html_e( 'MATERIAIS', 'isan-essencias' ); ?></span>
      <?php
      wp_nav_menu( [
          'theme_location' => 'footer-learn',
          'container'      => 'ul',
          'fallback_cb'    => 'isan_footer_learn_fallback',
      ] );
      ?>
    </div>

    <!-- Col 4: Endereço & Contato -->
    <div class="footer__col">
      <span class="footer__col-title">Isan Essências</span>
      <address class="footer__address">
        Rua Eli Valter César, 50 – Jardim Alvorada<br>
        CEP 06612-130 – Jandira/SP
      </address>

      <span class="footer__col-title footer__col-title--mt">Contato</span>
      <ul class="footer__contact">
        <li><a href="tel:+551146199999">+55 11 4619-9999</a></li>
        <li><a href="mailto:relacionamento@isan.com.br">relacionamento@isan.com.br</a></li>
      </ul>
    </div>

  </div><!-- /.footer__grid -->

  <!-- Bottom bar -->
  <div class="footer__bottom">

    <p class="footer__copy">
      <?php bloginfo( 'name' ); ?> &copy; <?php echo esc_html( date( 'Y' ) ); ?>
    </p>

    <div class="footer__socials">
      <!-- Instagram -->
      <a href="https://www.instagram.com/isanessencias" class="footer__social" aria-label="Instagram" rel="noopener noreferrer" target="_blank">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 3h4.4q1 0 2 .4a4 4 0 0 1 2.2 2.1q.3 1 .3 2a81 81 0 0 1-.3 11 4 4 0 0 1-2.1 2q-1 .4-2 .4a81 81 0 0 1-11-.3 4 4 0 0 1-2-2.1q-.5-1-.5-2a81 81 0 0 1 .4-11 4 4 0 0 1 2.1-2q1-.5 2-.5zm0-2H7.5Q6 1 4.8 1.7a6 6 0 0 0-3.2 3.2Q1 6.1 1 7.5L1 12v4.5q0 1.5.6 2.7a6 6 0 0 0 3.2 3.2q1.3.5 2.7.5l4.5.1h4.5q1.5 0 2.7-.6a6 6 0 0 0 3.2-3.2q.5-1.3.5-2.7L23 12V7.5q0-1.4-.6-2.7a6 6 0 0 0-3.2-3.2Q17.9 1 16.5 1zm0 14.7a4 4 0 0 1-3.4-2.3 3.7 3.7 0 1 1 3.4 2.3m5.9-8.2a1.3 1.3 0 1 0 0-2.7 1.3 1.3 0 0 0 0 2.7"/></svg>
      </a>
      <!-- LinkedIn -->
      <a href="https://www.linkedin.com/in/isan-ess%C3%AAncias-e-aromas-ltda-6a4487179/?originalSubdomain=br" class="footer__social" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">
        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23 0H1Q0 0 0 1v22q0 1 1 1h22q1 0 1-1V1q0-1-1-1M7.1 20.5H3.6V9h3.6v11.5zM5.3 7.4c-1.1 0-2.1-.9-2.1-2.1 0-1.1.9-2.1 2.1-2.1 1.1 0 2.1.9 2.1 2.1a2 2 0 0 1-2.1 2.1m15.2 13.1h-3.6v-5.6c0-1.3 0-3-1.8-3S13 13.3 13 14.8v5.7H9.4V9h3.4v1.6c.5-.9 1.6-1.8 3.4-1.8 3.6 0 4.3 2.4 4.3 5.5z"/></svg>
      </a>
    </div>

  </div>

  <script>
    // document.addEventListener('wpcf7messenger', function(event) {
    //     // Opcional: lógica após envio
    // }, false);

    jQuery(document).ready(function($) {
        $('.cnpj-mask').on('input', function() {
            var cnpj = $(this).val().replace(/\D/g, ''); // Remove tudo que não é número
            
            cnpj = cnpj.replace(/^(\d{2})(\d)/, "$1.$2");
            cnpj = cnpj.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            cnpj = cnpj.replace(/\.(\d{3})(\d)/, ".$1/$2");
            cnpj = cnpj.replace(/(\d{4})(\d)/, "$1-$2");
            
            $(this).val(cnpj.substring(0, 18)); // Limita o tamanho final
        });
    });
  </script>

</footer>

<!-- ═══ WHATSAPP BUTTON ══════════════════════════════════ -->
<a href="https://wa.me/5511992486368?text=Ol%C3%A1!%20Estava%20no%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es"
   class="whatsapp-btn"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="<?php esc_attr_e( 'Fale conosco pelo WhatsApp', 'isan-essencias' ); ?>">
  <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
  </svg>
</a>

<?php wp_footer(); ?>
</body>
</html>
