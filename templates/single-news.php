<?php get_header(); the_post(); ?>
	<div class="news-single">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="news-single__image">
				<?php the_post_thumbnail(); ?>
			</div><!-- news-single__image -->
		<?php endif; ?>

		<h2 class="news-single__title">
			<?php the_title(); ?>
		</h2><!-- news-single__title -->

		<div class="news-single__content">
			<?php the_content(); ?>
		</div><!-- news-single__content -->
	</div><!-- news-single -->
<?php get_footer();