<?php
$param = 'paged';
if ( is_front_page() ) {
	$param = 'page';
}

$paged = ( get_query_var( $param ) ) ? get_query_var( $param ) : 1;

$news_loop = new WP_Query( array(
	'post_type' => 'crb_news',
	'posts_per_page' => $news['posts_per_page'],
	'order' => $news['sort'],
	'paged' => $paged
) );

if ( ! $news_loop->have_posts() ) {
	return;
}
$index = 0;
?>

<div class="news">
	<div class="news-container">
		<?php while ( $news_loop->have_posts() ) : $news_loop->the_post(); ?>
			<div class="news-item">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="news-item__image">
						<?php the_post_thumbnail('full'); ?>

						<?php if ( $index === 0 && $paged === 1 ) : ?>
							<div class="news-item__featured">
								<img src="<?php echo NEWS_MANAGER_URL; ?>resources/images/feature-md.png">
							</div><!-- news-item__featured -->
						<?php endif; ?>
					</div><!-- news-item__image -->
				<?php endif; ?>

				<p class="news-item__date">
					<?php the_time( 'F jS, Y ' ); ?>
				</p><!-- news-item__date -->

				<h3 class="news-item__title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3><!-- news-item__title -->

				<div class="news-item__content">
					<?php the_excerpt(); ?>
				</div><!-- news-item__content -->
			</div><!-- news-item -->

			<?php $index++; ?>
		<?php endwhile; ?>

		<?php wp_reset_postdata(); ?>
	</div><!-- news-container -->

	<div class="news__actions">
	<?php
	$spinner = "<img class='spinner' src='" . NEWS_MANAGER_URL . "resources/images/spinner.gif'>";

	carbon_pagination( 'posts', [
		'current_page' => $paged,
		'total_pages' => $news_loop->max_num_pages,
		'prev_html' => false,
		'number_html' => false,
		'next_html' => '<a href="{URL}" class="paging__next">' . $spinner . esc_html__( 'Load More', 'crb' ) . '</a>',
	] );
	?>
	</div><!-- news__actions -->
</div><!-- news -->