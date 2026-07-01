<?php
/**
 * Page template.
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
				<h1 style="font-size:38px; line-height:1.15; margin-bottom:24px;"><?php the_title(); ?></h1>
				<div style="font-size:16px; line-height:1.75;">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>
</section>

<?php
get_footer();
