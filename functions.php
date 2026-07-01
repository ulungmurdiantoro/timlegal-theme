<?php
/**
 * TimLegal.id theme functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TIMLEGAL_VERSION', '1.0.0' );

/**
 * Theme setup.
 */
function timlegal_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	// Custom logo — defaults to the bundled logo file, editable from Customizer > Site Identity.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 24,
			'width'       => 150,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Menu Utama', 'timlegal' ),
			'footer-layanan'    => __( 'Footer - Layanan', 'timlegal' ),
			'footer-perusahaan' => __( 'Footer - Perusahaan', 'timlegal' ),
		)
	);
}
add_action( 'after_setup_theme', 'timlegal_setup' );

/**
 * Force the custom logo markup to render at a fixed size so the WordPress
 * frontend respects the intended logo dimensions.
 */
function timlegal_force_custom_logo_size( $html, $blog_id ) {
	$html = preg_replace( '/width="[^"]*"/', 'width="150"', $html );
	$html = preg_replace( '/height="[^"]*"/', 'height="24"', $html );

	return $html;
}
add_filter( 'get_custom_logo', 'timlegal_force_custom_logo_size', 10, 2 );

/**
 * Set a default custom logo on first activation so the bundled image
 * is used immediately, without requiring manual Customizer setup.
 */
function timlegal_set_default_logo() {
	if ( get_theme_mod( 'custom_logo' ) ) {
		return;
	}

	$logo_path = get_template_directory() . '/assets/images/logo.png';
	if ( ! file_exists( $logo_path ) ) {
		return;
	}

	$existing = get_posts(
		array(
			'post_type'      => 'attachment',
			'title'          => 'timlegal-logo',
			'posts_per_page' => 1,
			'post_status'    => 'inherit',
		)
	);
	if ( ! empty( $existing ) ) {
		set_theme_mod( 'custom_logo', $existing[0]->ID );
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	$upload_dir = wp_upload_dir();
	$filename   = 'timlegal-logo.png';
	$dest_path  = trailingslashit( $upload_dir['path'] ) . $filename;

	if ( ! file_exists( $dest_path ) ) {
		copy( $logo_path, $dest_path );
	}

	if ( ! file_exists( $dest_path ) ) {
		return;
	}

	$filetype   = wp_check_filetype( $filename, null );
	$attachment = array(
		'post_mime_type' => $filetype['type'],
		'post_title'      => 'timlegal-logo',
		'post_content'    => '',
		'post_status'     => 'inherit',
	);

	$attach_id = wp_insert_attachment( $attachment, $dest_path );
	if ( ! is_wp_error( $attach_id ) && $attach_id ) {
		$attach_data = wp_generate_attachment_metadata( $attach_id, $dest_path );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_theme_mod( 'custom_logo', $attach_id );
	}
}
add_action( 'after_switch_theme', 'timlegal_set_default_logo' );

/**
 * Enqueue styles and scripts.
 */
function timlegal_scripts() {
	wp_enqueue_style(
		'timlegal-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'timlegal-style', get_stylesheet_uri(), array(), TIMLEGAL_VERSION );

	wp_enqueue_script( 'timlegal-main', get_template_directory_uri() . '/assets/js/main.js', array(), TIMLEGAL_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'timlegal_scripts' );

/**
 * Fallback menu markup matching the original one-page anchor navigation,
 * used when no "Menu Utama" has been assigned in Appearance > Menus.
 */
function timlegal_primary_menu_fallback() {
	$home = esc_url( home_url( '/' ) );
	echo '<ul>';
	echo '<li><a href="' . $home . '#hot-topic">Pelaporan Rutin</a></li>';
	echo '<li><a href="' . $home . '#subscription">Legal &amp; System Partner</a></li>';
	echo '<li><a href="' . $home . '#ekosistem">Perizinan</a></li>';
	echo '<li><a href="' . $home . '#tentang">Tentang Kami</a></li>';
	echo '<li><a href="' . $home . '#artikel">Artikel</a></li>';
	echo '</ul>';
}

/**
 * Render the consultation contact form. Registered as [timlegal_contact_form].
 */
function timlegal_contact_form_shortcode() {
	ob_start();

	if ( isset( $_GET['timlegal_sent'] ) ) {
		if ( '1' === $_GET['timlegal_sent'] ) {
			echo '<p style="background:#E6EFE3;color:#3C6B35;padding:14px 16px;border-radius:4px;margin-bottom:18px;font-size:14px;">Terima kasih, permintaan konsultasi Anda telah terkirim. Tim kami akan segera menghubungi Anda.</p>';
		} else {
			echo '<p style="background:#F8E9D9;color:#8E6F34;padding:14px 16px;border-radius:4px;margin-bottom:18px;font-size:14px;">Maaf, terjadi kesalahan saat mengirim permintaan. Silakan coba lagi atau hubungi kami lewat WhatsApp.</p>';
		}
	}
	?>
	<h3 style="font-size:20px; margin-bottom:22px;">Ajukan Konsultasi</h3>
	<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="timlegal_submit_contact">
		<?php wp_nonce_field( 'timlegal_submit_contact', 'timlegal_contact_nonce' ); ?>
		<div class="form-row">
			<label for="timlegal_name">Nama Lengkap</label>
			<input type="text" id="timlegal_name" name="timlegal_name" required placeholder="Nama Anda">
		</div>
		<div class="form-row">
			<label for="timlegal_phone">Nomor WhatsApp</label>
			<input type="text" id="timlegal_phone" name="timlegal_phone" required placeholder="08xx-xxxx-xxxx">
		</div>
		<div class="form-row">
			<label for="timlegal_business">Jenis Usaha</label>
			<select id="timlegal_business" name="timlegal_business">
				<option>PT Industri Sigaret</option>
				<option>CV Industri Sigaret</option>
				<option>PT/CV Non-Sigaret</option>
				<option>Belum berbadan hukum</option>
			</select>
		</div>
		<div class="form-row">
			<label for="timlegal_message">Kebutuhan</label>
			<textarea id="timlegal_message" name="timlegal_message" placeholder="Ceritakan kebutuhan Anda — misal: RUPS &amp; Laporan Tahunan, LKPM, SIINAS, atau Corporate Legal & System Partner."></textarea>
		</div>
		<button class="btn btn-primary" style="width:100%; justify-content:center;" type="submit">Kirim Permintaan Konsultasi</button>
	</form>
	<?php
	return ob_get_clean();
}
add_shortcode( 'timlegal_contact_form', 'timlegal_contact_form_shortcode' );

/**
 * Handle consultation form submissions (logged-in and guest visitors).
 */
function timlegal_handle_contact_submission() {
	$redirect = home_url( '/#kontak' );

	if (
		! isset( $_POST['timlegal_contact_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['timlegal_contact_nonce'] ) ), 'timlegal_submit_contact' )
	) {
		wp_safe_redirect( add_query_arg( 'timlegal_sent', '0', $redirect ) );
		exit;
	}

	$name     = isset( $_POST['timlegal_name'] ) ? sanitize_text_field( wp_unslash( $_POST['timlegal_name'] ) ) : '';
	$phone    = isset( $_POST['timlegal_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['timlegal_phone'] ) ) : '';
	$business = isset( $_POST['timlegal_business'] ) ? sanitize_text_field( wp_unslash( $_POST['timlegal_business'] ) ) : '';
	$message  = isset( $_POST['timlegal_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['timlegal_message'] ) ) : '';

	if ( '' === $name || '' === $phone ) {
		wp_safe_redirect( add_query_arg( 'timlegal_sent', '0', $redirect ) );
		exit;
	}

	$to      = get_option( 'admin_email' );
	$subject = sprintf( '[timlegal.id] Permintaan Konsultasi dari %s', $name );
	$body    = "Nama Lengkap: {$name}\n" .
		"Nomor WhatsApp: {$phone}\n" .
		"Jenis Usaha: {$business}\n\n" .
		"Kebutuhan:\n{$message}";

	$sent = wp_mail( $to, $subject, $body );

	wp_safe_redirect( add_query_arg( 'timlegal_sent', $sent ? '1' : '0', $redirect ) );
	exit;
}
add_action( 'admin_post_timlegal_submit_contact', 'timlegal_handle_contact_submission' );
add_action( 'admin_post_nopriv_timlegal_submit_contact', 'timlegal_handle_contact_submission' );
