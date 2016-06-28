<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package DHN
 */

?>

<?php if ( is_archive() ) { ?>
	<div class="grid-item">
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if (is_archive()) {
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail();
			echo '</a>';
		}
	?>

	<header class="entry-header">

		<?php
			if ( is_single() ) {
				the_title( '<h2 class="entry-title">', '</h2>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>

			<div class="entry-meta">
				<?php the_date(); //dhn_posted_on(); ?>
	
				<?php if (!is_archive()) { ?>
					<div class="entry-tags">
						<?php dhn_entry_footer(); ?>
					</div>
				<?php } ?>

			</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if (is_archive()) {
				if (get_post_type() == 'projects') {
//					the_excerpt();

					echo get_custom_excerpt(15);

					the_terms(get_the_ID(), 'projects-tags', '<br/><br/><div class="entry-tags">', '', '</div><hr/>');

					the_terms(get_the_ID(), 'projects-countries', '<div class="entry-tags">', '', '</div>');
				}
				else {
					the_excerpt();
				}
			}
			else {			
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'dhn' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );
			}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dhn' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
<?php if ( is_archive() ) { ?>
	</div>
<?php } ?>
