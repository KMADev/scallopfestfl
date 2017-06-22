<?php

$mlsLead     = new kmaLeads();
$ADMIN_EMAIL = 'bryan@kerigan.com';
$DOMAIN_NAME = 'scallopfestfl.org';

//DEFAULT FORM VARS
$yourname            = ( isset( $_GET['your_name'] ) ? $_GET['your_name'] : '' );
$contactperson       = ( isset( $_GET['contact_person'] ) ? $_GET['contact_person'] : '' );
$youremail           = ( isset( $_GET['your_email'] ) ? $_GET['your_email'] : '' );
$phone               = ( isset( $_GET['phone'] ) ? $_GET['phone'] : '' );
$address             = ( isset( $_GET['address'] ) ? $_GET['address'] : '' );
$address_2           = ( isset( $_GET['address_2'] ) ? $_GET['address_2'] : '' );
$city                = ( isset( $_GET['city'] ) ? $_GET['city'] : '' );
$state               = ( isset( $_GET['state'] ) ? $_GET['state'] : '' );
$zip                 = ( isset( $_GET['zip'] ) ? $_GET['zip'] : '' );
$passCheck           = false;
$message             = '';
$website             = ( isset( $_GET['website'] ) ? $_GET['website'] : '' );
$describeBooth       = ( isset( $_GET['describe_booth'] ) ? $_GET['describe_booth'] : '' );
$formID              = ( isset( $_POST['formID'] ) ? $_POST['formID'] : '' );
$securityFlag        = ( isset( $_POST['secu'] ) ? $_POST['secu'] : '' );
$formSubmitted       = ( $formID == 'volunteer' && $securityFlag == '' ? true : false );
$emailformattedbadly = false;

if ( $formSubmitted ) { //FORM WAS SUBMITTED

	//OVERRIDE DEFAULTS IF FORM POSTED
	$yourname      = ( isset( $_POST['your_name'] ) ? $_POST['your_name'] : $yourname );
	$contactperson = ( isset( $_POST['contact_person'] ) ? $_POST['contact_person'] : $contactperson );
	$youremail     = ( isset( $_POST['your_email'] ) ? $_POST['your_email'] : $youremail );
	$phone         = ( isset( $_POST['phone'] ) ? $_POST['phone'] : $phone );
	$address       = ( isset( $_POST['address'] ) ? $_POST['address'] : $address );
	$address_2     = ( isset( $_POST['address_2'] ) ? $_POST['address_2'] : $address_2 );
	$city          = ( isset( $_POST['city'] ) ? $_POST['city'] : $city );
	$state         = ( isset( $_POST['state'] ) ? $_POST['state'] : $state );
	$zip           = ( isset( $_POST['zip'] ) ? $_POST['zip'] : $zip );
	$message       = ( isset( $_POST['additional_info'] ) ? $_POST['additional_info'] : $message );
	$website       = ( isset( $_POST['website'] ) ? $_POST['website'] : $message );

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
		'Phone Number'      => $cellphone,
		'Cell Phone Number' => $phone,
		'Address'           => $address . ' ' . $address_2 . '<br>' . $city . ' ' . $state . ', ' . $zip,
		'Website'           => $website,
		'Booth Type'        => $boothtype,
		'Description'       => htmlentities( stripslashes( $description ) ),
		'Category'          => htmlentities( stripslashes( $message ) ),
		'Additional Feet'   => $additionalfeet,
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
?>
<a id="vounteer-form" class="pad-anchor"></a>
<form class="form leadform" enctype="multipart/form-data" method="post" action="#vounteer-form">
    <input type="hidden" name="formID" value="volunteer">
    <div class="row">
        <div class="col-md-4">
            <label for="your_name" class="sr-only">Business Name *</label>
            <div class="input-group mb-2 <?php echo( $yourname == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <input name="your_name" type="text" id="your_name"
                       class="textbox form-control <?php echo( $yourname == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $yourname != '' ? $yourname : '' ); ?>" required
                       placeholder="Business Name *">
            </div>
        </div>
        <div class="col-md-4">
            <label for="contact_person" class="sr-only">Contact Person *</label>
            <div class="input-group mb-2 <?php echo( $contactperson == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <input name="contact_person" type="text" id="contatct_person"
                       class="textbox form-control <?php echo( $contactperson == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $contactperson != '' ? $contactperson : '' ); ?>" required
                       placeholder="Contact Person*">
            </div>
        </div>
        <div class="col-md-4">
            <label for="your_email" class="sr-only">Email Address *</label>
            <div class="input-group mb-2 <?php echo( $youremail == '' && $formSubmitted || $emailformattedbadly ? 'has-danger' : '' ); ?>">
                <input name="your_email" type="text" id="your_email"
                       class="textbox form-control <?php echo( $youremail == '' && $formSubmitted || $emailformattedbadly ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $youremail != '' ? $youremail : '' ); ?>" required
                       placeholder="Email Address *">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <label for="address" class="sr-only">Address *</label>
            <div class="input-group mb-2 <?php echo( $address == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <input name="address" type="text"
                       id="address <?php echo( $address && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $address != '' ? $address : '' ); ?>"
                       class="textbox form-control" required placeholder="Address *">
            </div>
        </div>
        <div class="col-md-4">
            <label for="address_2" class="sr-only">Apt/Suite *</label>
            <div class="input-group mb-2">
                <input name="address_2" type="text" id="address_2" class="textbox form-control"
                       value="<?php echo( ! $passCheck && $address_2 != '' ? $address_2 : '' ); ?>"
                       placeholder="Apt/Suite">
            </div>
        </div>
        <div class="col-md-5">
            <label for="city" class="sr-only">City *</label>
            <div class="input-group mb-2 <?php echo( $city == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <input name="city" type="text" id="city"
                       class="textbox form-control <?php echo( $city == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $city != '' ? $city : '' ); ?>" required placeholder="City *">
            </div>
        </div>
        <div class="col-md-4">
            <label for="state" class="sr-only">State *</label>
            <div class="input-group mb-2 <?php echo( $state == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <select class="form-control <?php echo( $state == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                        required name="state">
					<?php
					include( locate_template( 'template-parts/content-states.php' ) );
					?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label for="zip" class="sr-only">Zip *</label>
            <div class="input-group mb-2 <?php echo( $zip == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <input name="zip" type="text" id="zip"
                       class="textbox form-control <?php echo( $zip == '' && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $zip != '' ? $zip : '' ); ?>" required placeholder="Zip *">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="website" class="sr-only">Website</label>
            <div class="input-group mb-2">
                <input name="website" type="text" id="contatct_person"
                       class="textbox form-control"
                       value="<?php echo( ! $passCheck && $website != '' ? $website : '' ); ?>"
                       placeholder="Website">
            </div>
        </div>
        <div class="col-md-3">
            <label for="phone" class="sr-only">Phone Number *</label>
            <div class="input-group mb-2 <?php echo( $phone == '' && $formSubmitted ? 'has-danger' : '' ); ?>">
                <input name="phone" type="text" id="phone"
                       class="textbox form-control <?php echo( $phone && $formSubmitted ? 'form-control-danger' : '' ); ?>"
                       value="<?php echo( ! $passCheck && $phone != '' ? $phone : '' ); ?>"
                       placeholder="Phone Number *">
            </div>
        </div>
    </div>
    <div class="radio">
        <label for="booth_type" class="label">Booth Type <sup>*</sup>:</label>
        <label>
            <input type="radio" name="booth_type" id="booth_type_tent" value="Tent">
            Tent
        </label>
        <label>
            <input type="radio" name="booth_type" id="booth_type_trailer" value="Trailer">
            Trailer
        </label>
        <label>
            <input type="radio" name="booth_type" id="booth_type_other" value="Other">
            Other
        </label>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="describe_booth" class="label">If other, please describe</label>
                <textarea name="describe_booth" rows="4" class="form-control" placeholder="Describe Booth"
                          style="height: 130px;"><?php echo( ! $passCheck && $describeBooth != '' ? stripslashes( $describeBooth ) : '' ); ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="additional_info" class="sr-only">Description: Please list items to be sold</label>
                <textarea name="additional_info" rows="4" class="form-control"
                          placeholder="Description: Please list items to be sold"
                          style="height: 130px;"><?php echo( ! $passCheck && $message != '' ? stripslashes( $message ) : '' ); ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p>Participating vendors shall not market, sell or otherwise distribute items of any type that bear the name
                of "Florida Scallop & Music Festival" without express written consent of the Florida Scallop & Music
                Festival, Inc. Violation will result in immediate non-refundable expulsion.</p>

            <p>Pricing: includes 7% sales tax on the space. All prices shown are based on 12 ft. frontage non-food
                vendors; food vendors - 16 ft frontage. For each additional foot $26.75.</p>
        </div>
    </div>
    <div class="row">
        <div class="radio">
            <label for="booth_type" class="label">Category *</label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Arts and Crafts (no power - $120)">
                12 ft. frontage Arts and Crafts (no power - $120)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Arts and Crafts (110v - $135)">
                12 ft. frontage Arts and Crafts (110v - $135)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Commercial Vendors-NO product sales (no power - $175)">
                12 ft. frontage Commercial Vendors-NO product sales (no power - $175)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Commercial Vendors-NO product sales (110v - $190)">
                12 ft. frontage Commercial Vendors-NO product sales (110v - $190)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Commercial Vendors-with product sales (no power - $355)">
                12 ft. frontage Commercial Vendors-with product sales (no power - $355)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Commercial Vendors-with product sales (110v - $370)">
                12 ft. frontage Commercial Vendors-with product sales (110v - $370)
            </label>
            <label>
                <input type="radio" name="category" value="16 ft. frontage Food Vendors (no power - $355)">
                16 ft. frontage Food Vendors (no power - $355)
            </label>
            <label>
                <input type="radio" name="category" value="16 ft. frontage Food Vendors (110v - $370)">
                16 ft. frontage Food Vendors (110v - $370)
            </label>
            <label>
                <input type="radio" name="category" value="16 ft. frontage Food Vendors (220v - $455)">
                16 ft. frontage Food Vendors (220v - $455)
            </label>
            <label>
                <input type="radio" name="category" value="16 ft. frontage Snack Vendors (no power - $275)">
                16 ft. frontage Snack Vendors (no power - $275)
            </label>
            <label>
                <input type="radio" name="category" value="16 ft. frontage Snack Vendors (110v - $290)">
                16 ft. frontage Snack Vendors (110v - $290)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Non-profit - Educational/Churches (no power - $60)">
                12 ft. frontage Non-profit - Educational/Churches (no power - $60)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Non-profit - Educational/Churches (110v - $75)">
                12 ft. frontage Non-profit - Educational/Churches (110v - $75)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Political (no power - $120)">
                12 ft. frontage Political (no power - $120)
            </label>
            <label>
                <input type="radio" name="category" value="12 ft. frontage Political (110v - $135)">
                12 ft. frontage Political (110v - $135)
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <input type="text" name="secu"
                       style="position: absolute; height: 1px; top: -50px; left: -50px; width: 1px; padding: 0; margin: 0; visibility: hidden;">
                <button type="submit" class="btn btn-primary btn-md mb-2">Submit Application</button>
            </div>
        </div>
    </div>
