<?php
/**
 * Single post template.
 */

get_header();
?>

<section>
	<div class="wrap" style="max-width:760px;">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class(); ?>>
				<div class="bab"><?php echo esc_html( wp_strip_all_tags( get_the_category_list( ', ' ) ) ); ?></div>
				<h1 style="font-size:38px; line-height:1.15; margin:14px 0 10px;"><?php the_title(); ?></h1>
				<p style="color:var(--ink-soft); font-size:13.5px; margin-bottom:34px;"><?php echo esc_html( get_the_date() ); ?></p>
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="margin-bottom:34px;"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php endif; ?>
				<div style="font-size:16px; line-height:1.75;">
					<?php the_content(); ?>
				</div>
			</article>
			<div style="margin-top:40px;">
				<a href="<?php echo esc_url( home_url( '/#artikel' ) ); ?>" class="btn btn-ghost">← Kembali ke Artikel</a>
			</div>
			<?php
		endwhile;
		?>
	</div>
</section>

<?php
get_footer();
