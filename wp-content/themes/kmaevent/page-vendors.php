<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package kmaevent
 */

$mlsLead     = new kmaLeads();
$ADMIN_EMAIL = 'info@scallopfestfl.org';
$DOMAIN_NAME = 'scallopfestfl.org';

//DEFAULT FORM VARS
$yourname            = ( isset( $_GET['your_name'] ) ? $_GET['your_name'] : '' );
$contactperson       = ( isset( $_GET['contact_person'] ) ? $_GET['contact_person'] : '' );
$youremail           = ( isset( $_GET['your_email'] ) ? $_GET['your_email'] : '' );
$category            = ( isset( $_GET['category'] ) ? $_GET['category'] : '' );
$phone               = ( isset( $_GET['phone'] ) ? $_GET['phone'] : '' );
$address             = ( isset( $_GET['address'] ) ? $_GET['address'] : '' );
$address_2           = ( isset( $_GET['address_2'] ) ? $_GET['address_2'] : '' );
$city                = ( isset( $_GET['city'] ) ? $_GET['city'] : '' );
$state               = ( isset( $_GET['state'] ) ? $_GET['state'] : '' );
$zip                 = ( isset( $_GET['zip'] ) ? $_GET['zip'] : '' );
$passCheck           = false;
$message             = '';
$website             = ( isset( $_GET['website'] ) ? $_GET['website'] : '' );
$boothtype           = ( isset( $_GET['boothtype '] ) ? $_GET['boothtype '] : '' );
$describeBooth       = ( isset( $_GET['describe_booth'] ) ? $_GET['describe_booth'] : '' );
$vendortype          = ( isset( $_GET['vendortype'] ) ? $_GET['vendortype'] : '' );
$additionalFeet      = ( isset( $_GET['additional_feet'] ) ? $_GET['additional_feet'] : '' );
$formID              = ( isset( $_POST['formID'] ) ? $_POST['formID'] : '' );
$category            = ( isset( $_GET['category'] ) ? $_GET['category'] : '' );
$formSubmitted       = ( $formID == 'vendor' ? true : false );
$emailformattedbadly = false;

if ( $formSubmitted ) { //FORM WAS SUBMITTED

	//OVERRIDE DEFAULTS IF FORM POSTED
	$yourname       = ( isset( $_POST['your_name'] ) ? $_POST['your_name'] : $yourname );
	$contactperson  = ( isset( $_POST['contact_person'] ) ? $_POST['contact_person'] : $contactperson );
	$youremail      = ( isset( $_POST['your_email'] ) ? $_POST['your_email'] : $youremail );
	$phone          = ( isset( $_POST['phone'] ) ? $_POST['phone'] : $phone );
	$cellphone      = ( isset( $_POST['cellphone'] ) ? $_POST['cellphone'] : $phone );
	$address        = ( isset( $_POST['address'] ) ? $_POST['address'] : $address );
	$address_2      = ( isset( $_POST['address_2'] ) ? $_POST['address_2'] : $address_2 );
	$city           = ( isset( $_POST['city'] ) ? $_POST['city'] : $city );
	$state          = ( isset( $_POST['state'] ) ? $_POST['state'] : $state );
	$zip            = ( isset( $_POST['zip'] ) ? $_POST['zip'] : $zip );
	$message        = ( isset( $_POST['additional_info'] ) ? $_POST['additional_info'] : $message );
	$website        = ( isset( $_POST['website'] ) ? $_POST['website'] : $website );
	$boothtype      = ( isset( $_POST['boothtype'] ) ? $_POST['boothtype'] : $boothtype );
	$category       = ( isset( $_POST['category'] ) ? $_POST['category'] : $category );
	$additionalFeet = ( isset( $_POST['additional_feet'] ) ? $_POST['additional_feet'] : $additionalFeet );
	$describeBooth  = ( isset( $_POST['describe_booth'] ) ? $_POST['describe_booth'] : $describeBooth );
	$vendortype     = ( isset( $_POST['vendortype'] ) ? $_POST['vendortype'] : $vendortype );

	//BEGIN CHECKS
	$passCheck = true;
	$adderror  = '';

	if ( $youremail == '' ) {
		$passCheck = false;
		$adderror .= '<li>Email address is required.</li>';
	} elseif ( ! filter_var( $youremail, FILTER_VALIDATE_EMAIL ) && ! preg_match( '/@.+\./', $youremail ) ) {
		$passCheck           = false;
		$emailformattedbadly = true;
		$adderror .= '<li>Email is formatted incorrectly.</li>';
	}
	if ( $yourname == '' ) {
		$passCheck = false;
		$adderror .= '<li>Name is required.</li>';
	}

	//BEGIN EMAIL
	$sendadmin = array(
		'to'      => $ADMIN_EMAIL,
		'from'    => get_bloginfo() . ' <noreply@' . $DOMAIN_NAME . '>',
		'subject' => 'Vendor form submitted on website',
		'bcc'     => 'support@kerigan.com',
		'replyto' => $youremail
	);

	$sendreceipt = array(
		'to'      => $youremail,
		'from'    => get_bloginfo() . ' <noreply@' . $DOMAIN_NAME . '>',
		'subject' => 'Your vendor application',
		'bcc'     => 'support@kerigan.com'
	);

	$emailvars = array(
		'Business Name'     => $yourname,
		'Contact Person'    => $contactperson,
		'Email Address'     => $youremail,
		'Phone Number'      => $phone,
		'Cell Phone Number' => $cellphone,
		'Address'           => $address . ' ' . $address_2 . '<br>' . $city . ' ' . $state . ', ' . $zip,
		'Website'           => $website,
		'Booth Type'        => $boothtype,
		'Description'       => htmlentities( stripslashes( $describeBooth ) ),
		'Items Sold'        => htmlentities( stripslashes( $message ) ),
		'Category'          => $category,
		'Additional Feet'   => $additionalFeet,
	);

	$successmessage = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> <strong>Your application has been received. Our staff will review your submission and get back with you soon.</strong>';
	$errormessage   = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Errors were found. Please correct the indicated fields below.';

	$fontstyle     = 'font-family: sans-serif;';
	$headlinestyle = 'style="font-size:20px; ' . $fontstyle . ' color:#42BC7B;"';
	$copystyle     = 'style="font-size:16px; ' . $fontstyle . ' color:#333;"';
	$labelstyle    = 'style="padding:4px 8px; background:#F7F6F3; border:1px solid #FFFFFF; font-weight:bold; ' . $fontstyle . ' font-size:14px; color:#4D4B47; width:150px;"';
	$datastyle     = 'style="padding:4px 8px; background:#F7F6F3; border:1px solid #FFFFFF; ' . $fontstyle . ' font-size:14px;"';

	$headline         = '<h2 ' . $headlinestyle . '>Vendor Form Submission</h2>';
	$receiptheadline  = '<h2 ' . $headlinestyle . '>Your vendor application</h2>';
	$adminintrocopy   = '<p ' . $copystyle . '>You have received a vendor form submission from the website. Details are below:</p>';
	$receiptintrocopy = '<p ' . $copystyle . '>Your application has been received and we will get back with you as soon as we can. What you submitted is below:</p>';
	$dateofemail      = '<p ' . $copystyle . '>Date Submitted: ' . date( 'M j, Y' ) . ' @ ' . date( 'g:i a' ) . '</p>';

	$submittedData = '<table cellpadding="0" cellspacing="0" border="0" style="width:100%" ><tbody>';
	foreach ( $emailvars as $key => $var ) {
		if ( ! is_array( $var ) ) {
			$submittedData .= '<tr><td ' . $labelstyle . ' >' . $key . '</td><td ' . $datastyle . '>' . $var . '</td></tr>';
		} else {
			$submittedData .= '<tr><td ' . $labelstyle . ' >' . $key . '</td><td ' . $datastyle . '>';
			foreach ( $var as $k => $v ) {
				$submittedData .= '<span style="display:block;width:100%;">' . $v . '</span><br>';
			}
			$submittedData .= '</ul></td></tr>';
		}
	}
	$submittedData .= '</tbody></table>';

	$adminContent   = $adminintrocopy . $submittedData . $dateofemail;
	$receiptContent = $receiptintrocopy . $submittedData . $dateofemail;

	$emaildata   = array(
		'headline'  => $headline,
		'introcopy' => $adminContent,
	);
	$receiptdata = array(
		'headline'  => $receiptheadline,
		'introcopy' => $receiptContent,
	);


	if ( $passCheck ) {

		echo '<div class="alert alert-success" role="alert">' . $successmessage . '</div>';
		//TODO: Check if Spam

		$isSpam = false;

		if ( $isSpam ) {


		} else {

			$mlsLead->sendEmail( $sendadmin, $emaildata );
			$mlsLead->sendEmail( $sendreceipt, $receiptdata );

			$emailTemplate = file_get_contents( get_template_directory() . '/modules/leads/emailtemplate.php' );
			$split         = strrpos( $emailTemplate, '<!--[content]-->' );
			$templatebot   = substr( $emailTemplate, $split );
			$templatetop   = substr( $emailTemplate, 0, $split );

			// store the comment normally
			$emailMessage = $templatetop . $emaildata['headline'] . $emaildata['introcopy'] . $templatebot;
			$leadId       = wp_insert_post(
				array( //POST INFO
					'post_content'   => '',
					'post_status'    => 'publish',
					'post_type'      => 'Lead',
					'post_title'     => $yourname,
					'comment_status' => 'closed',
					'ping_status'    => 'closed',
					'meta_input'     => array( //POST META
						'lead_info_lead_type'            => 'vendor',
						'lead_info_name'                 => $yourname,
						'lead_info_date'                 => date( 'M j, Y' ) . ' @ ' . date( 'g:i a e' ),
						'lead_info_phone_number'         => $phone,
						'lead_info_email_address'        => $youremail,
						'lead_info_message'              => $message,
						'lead_info_notification_preview' => $emailMessage,
					)
				), true
			);
			wp_set_object_terms( $leadId, 1414, 'type' );

		}

	} else { //ERRORS

		echo '<div class="alert alert-danger" role="alert">' . $errormessage;
		if ( $adderror != '' ) {
			echo '<ul>' . $adderror . '</ul>';
		}
		echo '</div>';

	}

}
get_header();

?>
    <div id="content" class="site-content">
        <div id="mid">

            <div class="container">

                <div id="primary" class="content-area">
                    <main id="main" class="site-main support" role="main">
                        <div class="row justify-content-center">
							<?php while ( have_posts() ) : the_post();
								$headline = ( $post->page_information_headline != '' ? $post->page_information_headline : $post->post_title );
								?>

                                <div class="col-xl-11">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                        <header class="entry-header">
                                            <h1 class="entry-title"><?php echo $headline; ?></h1>
                                        </header><!-- .entry-header -->

                                        <div class="entry-content">
                                            <hr>
                                            <p>&nbsp;</p>
											<?php the_content(); ?>
                                            <p>&nbsp;</p>
                                        </div>

                                        <div class="row justify-content-center">
                                            <div class="col-md-8">
                                                <div class="entry-content">
													<?php //get_template_part( 'template-parts/form', 'vendors' ); ?>
                                                    <a id="vounteer-form" class="pad-anchor"></a>
                                                    <form class="form leadform"
                                                          method="post" action="" id="vendor">
														<?php include( locate_template( 'template-parts/form-vendors.php' ) ) ?>
                                                    </form>
                                                </div><!-- .entry-content -->
                                            </div>
                                            <div class="col-md-4">
                                                <div class="entry-content offline-applications">
													<?php echo apply_filters( 'the_content', $post->offline_application_html ); ?>
                                                </div>
                                            </div>
                                        </div>

                                    </article><!-- #post-## -->
                                </div>

							<?php endwhile; // End of the loop. ?>
                        </div>
                    </main><!-- #main -->
                </div><!-- #primary -->

            </div>

        </div>
    </div>
<?php
get_footer();
