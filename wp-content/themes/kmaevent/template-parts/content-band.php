<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kmaevent
 */

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);

$bands = new Bands();
$band = $bands->getSingleBand($post->post_title);

$social = $band['social'];

$socialArray = array(
	'facebook'      => ($social['facebook']   != '' ? 'https://facebook.com'.$social['facebook'] : ''),
	'twitter'       => ($social['twitter']    != '' ? 'https://twitter.com'.$social['twitter'] : ''),
	'linkedin'      => ($social['linkedin']   != '' ? 'https://www.linkedin.com/in'.$social['linkedin'] : ''),
	'instagram'     => ($social['instagram']  != '' ? 'https://instagram.com'.$social['instagram'] : ''),
	'youtube'       => ($social['youtube']    != '' ? 'https://www.youtube.com/user'.$social['youtube'] : ''),
	'googleplus'    => ($social['googleplus']     != '' ? 'https://plus.google.com'.$social['googleplus'] : ''),
);

?>

<div class="col-xl-11">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php echo $headline; ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <hr>
        <p>&nbsp;</p>
        <div class="alignleft">
        <img src="<?php echo $band['photo']; ?>" class="img-fluid" style="max-width:400px;" >
            <div class="social"><span class="label">Follow Us:</span>
		        <?php foreach($socialArray as $social => $link){
			        echo ( $link != '' ? '<a href="'.$link.'" target="_blank">'.$bands->getSvg($social,true).'</a>' : '');
		        } ?>
            </div>
            <div class="contact">
		        <?php echo ($band['website']!='' ? '<a class="btn btn-info" href="'.$band['website'].'" target="_blank" >visit our website</a>' : ''); ?>
		        <?php echo ($band['email']!='' ? '<a class="btn btn-info" href="mailto:'.$band['email'].'" target="_blank" >email us</a>' : ''); ?>
            </div>
        </div>
        <h2><span class="day"><?php echo $band['day']; ?></span></h2>
        <h3><span class="time"><?php echo $band['time']; ?></span></h3>

		<?php echo $band['biography']; ?>


	</div><!-- .entry-content -->

</article><!-- #post-## -->
</div>
