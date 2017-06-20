<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kmaevent
 */

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
?>

<div class="col-xl-11">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $headline; ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
</div>
