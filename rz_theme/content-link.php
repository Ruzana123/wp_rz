<?php
/**
 * content-link.php
 *
 * The defailt template for displaying posts with the Link post format.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- Article content -->
	<div class="entry-content">
		<?php
			the_content( __( 'Continue reading &rarr;', 'rz_theme' ) );
		
			wp_link_pages();
		?>
	</div><!-- end entry-content -->
	
	<!-- Article footer -->
	<footer class="entry-footer">
		<p class="entry-meta">
			<?php
				// Display the meta information
				rz_theme_post_meta();
			?>
		</p>
		
		<?php
			// If we have a single page and the author bio exist, display it
			if (is_single() && get_the_author_meta( 'description' ) ) {
				echo '<h2>' . __( 'Written by ', 'rz_theme' ) . get_the_author() . '</h2>';
				echo '<p>' . the_author_meta( 'description' ) . '</p>';
			}
		?>
	</footer>


</article>
