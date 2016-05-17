<?php
/**
 * archive.php
 *
 * The template for displaying archive pages.
 */
?>

<?php get_header(); ?>

	<!-- Main Content -->
	<div class="main-content col-md-8" role="main">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1>
					<?php
						if ( is_day() ) {
							printf( __( 'Daily Archieves for %s', 'rz_theme' ), get_the_date() );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archieves for %s', 'rz_theme' ), 
								get_the_date( _x( 'F Y', 'Monthly archieves date format', 'rz_theme' ) )
							);
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archieves for %s', 'rz_theme' ), 
								get_the_date( _x( 'Y', 'Yearly archieves date format', 'rz_theme' ) )
							);
						} else {
							_e( 'Archieves', 'rz_theme' );
						}
					?>
				</h1>
			</header>

			<?php while( have_posts() ) : the_post() ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php rz_theme_paging_nav(); ?>

		<?php else: ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div><!--end main-content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>