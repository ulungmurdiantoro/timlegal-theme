<?php
/**
 * The main template file — fallback for the post loop.
 * The one-page design lives in front-page.php; this file
 * renders when index.php is used outside the static front page
 * (e.g. blog listing, search results).
 */

get_header();

if ( is_front_page() ) :
	get_template_part( 'template-parts/content', 'front' );
else :
	$heading = is_search()
		? sprintf( 'Hasil pencarian: %s', esc_html( get_search_query() ) )
		: 'Artikel &amp; Edukasi';
	?>
	<section>
		<div class="wrap">
			<div class="section-head">
				<div>
					<div class="bab">Artikel</div>
					<h2><?php echo wp_kses_post( $heading ); ?></h2>
				</div>
			</div>

			<div class="article-grid">
				<?php if ( have_posts() ) : ?>
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<div class="article-card">
							<span class="article-tag"><?php echo esc_html( wp_strip_all_tags( get_the_category_list( ', ' ) ) ); ?></span>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
							<a href="<?php the_permalink(); ?>" class="read">Baca selengkapnya →</a>
						</div>
						<?php
					endwhile;
					?>
				<?php else : ?>
					<p>Belum ada artikel.</p>
				<?php endif; ?>
			</div>

			<?php the_posts_pagination(); ?>
		</div>
	</section>
	<?php
endif;

get_footer();
