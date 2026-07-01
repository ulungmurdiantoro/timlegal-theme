<?php
/**
 * The footer for the theme.
 */
?>
<!-- ============ FOOTER ============ -->
<footer>
  <div class="wrap">
    <div class="foot-grid">
      <div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
          <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/LOGO-TIMLEGAL-PUTIH.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
        <p style="max-width:280px;">Integrating business &amp; legality for sustainability. Tim legal &amp; government relations permanen untuk industri sigaret Indonesia.</p>
      </div>
      <div class="foot-cols">
        <div>
          <strong style="color:#fff; font-size:13px; margin-bottom:4px;">Layanan</strong>
          <?php
          if ( has_nav_menu( 'footer-layanan' ) ) {
            wp_nav_menu(
              array(
                'theme_location' => 'footer-layanan',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'depth'          => 1,
              )
            );
          } else {
            ?>
            <a href="#hot-topic">Pelaporan Rutin</a>
            <a href="#subscription">Legal &amp; System Partner</a>
            <a href="#ekosistem">Perizinan &amp; Ekosistem</a>
            <?php
          }
          ?>
        </div>
        <div>
          <strong style="color:#fff; font-size:13px; margin-bottom:4px;">Perusahaan</strong>
          <?php
          if ( has_nav_menu( 'footer-perusahaan' ) ) {
            wp_nav_menu(
              array(
                'theme_location' => 'footer-perusahaan',
                'container'      => false,
                'items_wrap'     => '%3$s',
                'depth'          => 1,
              )
            );
          } else {
            ?>
            <a href="#tentang">Tentang Kami</a>
            <a href="#artikel">Artikel</a>
            <a href="#kontak">Kontak</a>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="foot-bottom">
      <span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?> — All rights reserved.</span>
      <span>Semarang, Jawa Tengah, Indonesia</span>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
