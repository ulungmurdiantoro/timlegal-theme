<?php
/**
 * The header for the theme.
 */
?>
<!DOCTYPE html>
<html lang="<?php echo esc_attr( get_locale() === 'id_ID' ? 'id' : 'id' ); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ============ POPUP ============ -->
<div class="popup-overlay" id="popup">
  <div class="popup">
    <button class="popup-close" id="popup-close" type="button">✕</button>
    <div class="popup-top">
      <span class="tag">JULI 2026</span>
      <span>Momentum Pelaporan Tahunan</span>
    </div>
    <div class="popup-body">
      <h3>RUPS, Laporan Tahunan, LKPM &amp; SIINAS — tenggat Juni–Juli 2026</h3>
      <p>RUPS Tahunan paling lambat 30 Juni, dan saat ini KBLI 2025 sedang diimplementasikan ke Sistem OSS &amp; AHU. Cek kewajiban perusahaan Anda sebelum kena teguran atau pemblokiran akses.</p>
      <div class="popup-cta">
        <a href="#hot-topic" class="btn btn-primary popup-close-link">Lihat Layanan →</a>
        <button class="btn btn-ghost" id="popup-close-later" type="button">Nanti saja</button>
      </div>
    </div>
  </div>
</div>

<!-- ============ HEADER ============ -->
<header>
  <div class="ribbon">
    <div class="wrap">
      <span class="tag">PERHATIAN</span>
      <span>RUPS Tahunan paling lambat 30 Juni · KBLI 2025 sedang diimplementasikan ke Sistem AHU &amp; OSS</span>
      <a href="#hot-topic" class="link">Cek kewajiban Anda →</a>
    </div>
  </div>
  <div class="wrap nav-row">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>#top" class="logo">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
      <?php endif; ?>
    </a>
    <nav>
      <?php
      wp_nav_menu(
        array(
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '<ul>%3$s</ul>',
          'fallback_cb'    => 'timlegal_primary_menu_fallback',
        )
      );
      ?>
    </nav>
    <div class="nav-cta">
      <a href="#kontak" class="btn btn-ghost">Konsultasi</a>
      <a href="https://wa.me/6282146372002" class="btn btn-primary">WhatsApp Kami</a>
    </div>
  </div>
</header>
