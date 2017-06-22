<?php

$mlsLead = new kmaLeads();
$ADMIN_EMAIL = 'bryan@kerigan.com';
$DOMAIN_NAME = 'scallopfestfl.org';

//DEFAULT FORM VARS
$yourname               = (isset($_GET['your_name']) ? $_GET['your_name'] : '');
$youremail              = (isset($_GET['your_email']) ? $_GET['your_email'] : '');
$phone                  = (isset($_GET['phone']) ? $_GET['phone'] : '');
$address                = (isset($_GET['address']) ? $_GET['address'] : '');
$address_2              = (isset($_GET['address_2']) ? $_GET['address_2'] : '');
$city                   = (isset($_GET['city']) ? $_GET['city'] : '');
$state                  = (isset($_GET['state']) ? $_GET['state'] : '');
$zip                    = (isset($_GET['zip']) ? $_GET['zip'] : '');
$emailformattedbadly    = FALSE;
$passCheck              = FALSE;
$message                = '';

$formID                 = (isset($_POST['formID']) ? $_POST['formID'] : '');
$securityFlag           = (isset($_POST['secu']) ? $_POST['secu'] : '');
$formSubmitted          = ($formID == 'volunteer' && $securityFlag == '' ? TRUE : FALSE);

if( $formSubmitted ){ //FORM WAS SUBMITTED

	//OVERRIDE DEFAULTS IF FORM POSTED
	$yourname           = (isset($_POST['your_name']) ? $_POST['your_name'] : $yourname);
	$youremail          = (isset($_POST['your_email']) ? $_POST['your_email'] : $youremail);
	$phone              = (isset($_POST['phone']) ? $_POST['phone'] : $phone);
	$address            = (isset($_POST['address']) ? $_POST['address'] : $address);
	$address_2          = (isset($_POST['address_2']) ? $_POST['address_2'] : $address_2);
	$city               = (isset($_POST['city']) ? $_POST['city'] : $city);
	$state              = (isset($_POST['state']) ? $_POST['state'] : $state);
	$zip                = (isset($_POST['zip']) ? $_POST['zip'] : $zip);
	$message            = (isset($_POST['additional_info']) ? $_POST['additional_info'] : $message);

	//BEGIN CHECKS
	$passCheck = TRUE;
	$adderror = '';

	if($youremail == ''){
		$passCheck = FALSE;
		$adderror .= '<li>Email address is required.</li>';
	}elseif(!filter_var($youremail, FILTER_VALIDATE_EMAIL) && !preg_match('/@.+\./', $youremail)) {
		$passCheck = FALSE;
		$emailformattedbadly = TRUE;
		$adderror .= '<li>Email is formatted incorrectly.</li>';
	}
	if($yourname == ''){
		$passCheck = FALSE;
		$adderror .= '<li>Name is required.</li>';
	}

	//BEGIN EMAIL
	$sendadmin = array(
		'to'		=> $ADMIN_EMAIL,
		'from'		=> get_bloginfo().' <noreply@'.$DOMAIN_NAME.'>',
		'subject'	=> 'Volunteer form submitted on website',
		'bcc'		=> 'support@kerigan.com',
		'replyto'   => $youremail
	);

	$sendreceipt = array(
		'to'		=> $youremail,
		'from'		=> get_bloginfo().' <noreply@'.$DOMAIN_NAME.'>',
		'subject'	=> 'Your volunteer application',
		'bcc'		=> 'support@kerigan.com'
	);

	$emailvars = array(
		'Name'              => $yourname,
		'Email Address'     => $youremail,
		'Phone Number'      => $phone,
		'Address'           => $address.' '.$address_2.'<br>'.$city.' '.$state.', '.$zip,
		'Message'           => htmlentities(stripslashes($message)),
	);

	$successmessage     = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> <strong>Your application has been received. Our staff will review your submission and get back with you soon.</strong>';
	$errormessage       = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Errors were found. Please correct the indicated fields below.';

	$fontstyle          = 'font-family: sans-serif;';
	$headlinestyle      = 'style="font-size:20px; '.$fontstyle.' color:#42BC7B;"';
	$copystyle          = 'style="font-size:16px; '.$fontstyle.' color:#333;"';
	$labelstyle         = 'style="padding:4px 8px; background:#F7F6F3; border:1px solid #FFFFFF; font-weight:bold; '.$fontstyle.' font-size:14px; color:#4D4B47; width:150px;"';
	$datastyle          = 'style="padding:4px 8px; background:#F7F6F3; border:1px solid #FFFFFF; '.$fontstyle.' font-size:14px;"';

	$headline           = '<h2 '.$headlinestyle.'>Volunteer Form Submission</h2>';
	$receiptheadline    = '<h2 '.$headlinestyle.'>Your volunteer application</h2>';
	$adminintrocopy     = '<p '.$copystyle.'>You have received a volunteer form submission from the website. Details are below:</p>';
	$receiptintrocopy   = '<p '.$copystyle.'>Your application has been received and we will get back with you as soon as we can. What you submitted is below:</p>';
	$dateofemail        = '<p '.$copystyle.'>Date Submitted: '.date('M j, Y').' @ '.date('g:i a').'</p>';

	$submittedData = '<table cellpadding="0" cellspacing="0" border="0" style="width:100%" ><tbody>';
	foreach($emailvars as $key => $var ){
		if(!is_array($var)){
			$submittedData .= '<tr><td '.$labelstyle.' >'.$key.'</td><td '.$datastyle.'>'.$var.'</td></tr>';
		}else{
			$submittedData .= '<tr><td '.$labelstyle.' >'.$key.'</td><td '.$datastyle.'>';
			foreach($var as $k => $v){
				$submittedData .= '<span style="display:block;width:100%;">'.$v.'</span><br>';
			}
			$submittedData .= '</ul></td></tr>';
		}
	}
	$submittedData .= '</tbody></table>';

	$adminContent = $adminintrocopy.$submittedData.$dateofemail;
	$receiptContent = $receiptintrocopy.$submittedData.$dateofemail;

	$emaildata = array(
		'headline'	=> $headline,
		'introcopy'	=> $adminContent,
	);
	$receiptdata = array(
		'headline'	=> $receiptheadline,
		'introcopy'	=> $receiptContent,
	);


	if($passCheck){

		echo '<div class="alert alert-success" role="alert">'.$successmessage.'</div>';
		//TODO: Check if Spam

		$isSpam = FALSE;

		if( $isSpam ){


		} else {

			$mlsLead->sendEmail( $sendadmin, $emaildata );
			$mlsLead->sendEmail( $sendreceipt, $receiptdata );

			$emailTemplate  = file_get_contents(get_template_directory().'/modules/leads/emailtemplate.php');
			$split          = strrpos($emailTemplate, '<!--[content]-->');
			$templatebot    = substr($emailTemplate, $split);
			$templatetop    = substr($emailTemplate, 0, $split);

			// store the comment normally
			$emailMessage = $templatetop.$emaildata['headline'].$emaildata['introcopy'].$templatebot;
			$leadId = wp_insert_post(
				array( //POST INFO
					'post_content' => '',
					'post_status' => 'publish',
					'post_type' => 'Lead',
					'post_title' => $yourname,
					'comment_status' => 'closed',
					'ping_status' => 'closed',
					'meta_input' => array( //POST META
						'lead_info_lead_type' => 'volunteer',
						'lead_info_name' => $yourname,
						'lead_info_date' => date('M j, Y').' @ '.date('g:i a e'),
						'lead_info_phone_number' => $phone,
						'lead_info_email_address' => $youremail,
						'lead_info_message' => $message,
						'lead_info_notification_preview' => $emailMessage,
					)
				), true
			);
			wp_set_object_terms( $leadId, 1414, 'type' );

		}

	}else{ //ERRORS

		echo '<div class="alert alert-danger" role="alert">'.$errormessage;
		if($adderror != '') { echo '<ul>'.$adderror.'</ul>'; }
		echo '</div>';

	}

}
?>
<a id="vounteer-form" class="pad-anchor"></a>
<form class="form leadform" enctype="multipart/form-data" method="post" action="#vounteer-form" >
	<input type="hidden" name="formID" value="volunteer" >
	<div class="row">
		<div class="col-md-4">
			<label for="your_name" class="sr-only">Name *</label>
			<div class="input-group mb-2 <?php echo ( $yourname=='' && $formSubmitted ? 'has-danger' : ''); ?>">
				<input name="your_name" type="text" id="your_name" class="textbox form-control <?php echo ( $yourname=='' && $formSubmitted ? 'form-control-danger' : ''); ?>" value="<?php echo (!$passCheck && $yourname != '' ? $yourname : ''); ?>" required placeholder="Name *">
			</div>
		</div>
		<div class="col-md-4">
			<label for="your_email" class="sr-only">Email Address *</label>
			<div class="input-group mb-2 <?php echo( $youremail=='' && $formSubmitted || $emailformattedbadly ? 'has-danger' : ''); ?>">
				<input name="your_email" type="text" id="your_email" class="textbox form-control <?php echo( $youremail=='' && $formSubmitted || $emailformattedbadly ? 'form-control-danger' : ''); ?>" value="<?php echo (!$passCheck && $youremail != '' ? $youremail : ''); ?>" required placeholder="Email Address *">
			</div>
		</div>
		<div class="col-md-4">
			<label for="phone" class="sr-only">Phone Number *</label>
			<div class="input-group mb-2 <?php echo ( $phone=='' && $formSubmitted ? 'has-danger' : ''); ?>">
				<input name="phone" type="text" id="phone" class="textbox form-control <?php echo ( $phone && $formSubmitted ? 'form-control-danger' : ''); ?>" value="<?php echo (!$passCheck && $phone != '' ? $phone : ''); ?>" placeholder="Phone Number *">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<label for="address" class="sr-only">Address *</label>
			<div class="input-group mb-2 <?php echo ( $address=='' && $formSubmitted ? 'has-danger' : ''); ?>">
				<input name="address" type="text" id="address <?php echo ( $address && $formSubmitted ? 'form-control-danger' : ''); ?>" value="<?php echo (!$passCheck && $address != '' ? $address : ''); ?>" class="textbox form-control" required placeholder="Address *">
			</div>
		</div>
		<div class="col-md-4">
			<label for="address_2" class="sr-only">Apt/Suite *</label>
			<div class="input-group mb-2">
				<input name="address_2" type="text" id="address_2" class="textbox form-control" value="<?php echo (!$passCheck && $address_2 != '' ? $address_2 : ''); ?>" placeholder="Apt/Suite">
			</div>
		</div>
		<div class="col-md-5">
			<label for="city" class="sr-only">City *</label>
			<div class="input-group mb-2 <?php echo ( $city=='' && $formSubmitted ? 'has-danger' : ''); ?>">
				<input name="city" type="text" id="city" class="textbox form-control <?php echo ( $city=='' && $formSubmitted ? 'form-control-danger' : ''); ?>" value="<?php echo (!$passCheck && $city != '' ? $city : ''); ?>" required placeholder="City *">
			</div>
		</div>
		<div class="col-md-4">
			<label for="state" class="sr-only">State *</label>
			<div class="input-group mb-2 <?php echo ( $state=='' && $formSubmitted ? 'has-danger' : ''); ?>">
				<select class="form-control <?php echo ( $state=='' && $formSubmitted ? 'form-control-danger' : ''); ?>" required name="state">
					<option value="AL" <?php if($state == 'AL'){ echo 'selected'; } ?> >Alabama</option>
					<option value="AK" <?php if($state == 'AK'){ echo 'selected'; } ?> >Alaska</option>
					<option value="AZ" <?php if($state == 'AZ'){ echo 'selected'; } ?> >Arizona</option>
					<option value="AR" <?php if($state == 'AR'){ echo 'selected'; } ?> >Arkansas</option>
					<option value="CA" <?php if($state == 'CA'){ echo 'selected'; } ?> >California</option>
					<option value="CO" <?php if($state == 'CO'){ echo 'selected'; } ?> >Colorado</option>
					<option value="CT" <?php if($state == 'CT'){ echo 'selected'; } ?> >Connecticut</option>
					<option value="DE" <?php if($state == 'DE'){ echo 'selected'; } ?> >Delaware</option>
					<option value="FL" <?php if($state == 'FL' || $state == ''){ echo 'selected'; } ?> >Florida</option>
					<option value="GA" <?php if($state == 'GA'){ echo 'selected'; } ?> >Georgia</option>
					<option value="HI" <?php if($state == 'HI'){ echo 'selected'; } ?> >Hawaii</option>
					<option value="ID" <?php if($state == 'ID'){ echo 'selected'; } ?> >Idaho</option>
					<option value="IL" <?php if($state == 'IL'){ echo 'selected'; } ?> >Illinois</option>
					<option value="IN" <?php if($state == 'IN'){ echo 'selected'; } ?> >Indiana</option>
					<option value="IA" <?php if($state == 'IA'){ echo 'selected'; } ?> >Iowa</option>
					<option value="KS" <?php if($state == 'KS'){ echo 'selected'; } ?> >Kansas</option>
					<option value="KY" <?php if($state == 'KY'){ echo 'selected'; } ?> >Kentucky</option>
					<option value="LA" <?php if($state == 'LA'){ echo 'selected'; } ?> >Louisiana</option>
					<option value="ME" <?php if($state == 'ME'){ echo 'selected'; } ?> >Maine</option>
					<option value="MD" <?php if($state == 'MD'){ echo 'selected'; } ?> >Maryland</option>
					<option value="MA" <?php if($state == 'MA'){ echo 'selected'; } ?> >Massachusetts</option>
					<option value="MI" <?php if($state == 'MI'){ echo 'selected'; } ?> >Michigan</option>
					<option value="MN" <?php if($state == 'MN'){ echo 'selected'; } ?> >Minnesota</option>
					<option value="MS" <?php if($state == 'MS'){ echo 'selected'; } ?> >Mississippi</option>
					<option value="MO" <?php if($state == 'MO'){ echo 'selected'; } ?> >Missouri</option>
					<option value="MT" <?php if($state == 'MT'){ echo 'selected'; } ?> >Montana</option>
					<option value="NE" <?php if($state == 'NE'){ echo 'selected'; } ?> >Nebraska</option>
					<option value="NV" <?php if($state == 'NV'){ echo 'selected'; } ?> >Nevada</option>
					<option value="NH" <?php if($state == 'NH'){ echo 'selected'; } ?> >New Hampshire</option>
					<option value="NJ" <?php if($state == 'NJ'){ echo 'selected'; } ?> >New Jersey</option>
					<option value="NM" <?php if($state == 'NM'){ echo 'selected'; } ?> >New Mexico</option>
					<option value="NY" <?php if($state == 'NY'){ echo 'selected'; } ?> >New York</option>
					<option value="NC" <?php if($state == 'NC'){ echo 'selected'; } ?> >North Carolina</option>
					<option value="ND" <?php if($state == 'ND'){ echo 'selected'; } ?> >North Dakota</option>
					<option value="OH" <?php if($state == 'OH'){ echo 'selected'; } ?> >Ohio</option>
					<option value="OK" <?php if($state == 'OK'){ echo 'selected'; } ?> >Oklahoma</option>
					<option value="OR" <?php if($state == 'OR'){ echo 'selected'; } ?> >Oregon</option>
					<option value="PA" <?php if($state == 'PA'){ echo 'selected'; } ?> >Pennsylvania</option>
					<option value="RI" <?php if($state == 'RI'){ echo 'selected'; } ?> >Rhode Island</option>
					<option value="SC" <?php if($state == 'SC'){ echo 'selected'; } ?> >South Carolina</option>
					<option value="SD" <?php if($state == 'SD'){ echo 'selected'; } ?> >South Dakota</option>
					<option value="TN" <?php if($state == 'TN'){ echo 'selected'; } ?> >Tennessee</option>
					<option value="TX" <?php if($state == 'TX'){ echo 'selected'; } ?> >Texas</option>
					<option value="UT" <?php if($state == 'UT'){ echo 'selected'; } ?> >Utah</option>
					<option value="VT" <?php if($state == 'VT'){ echo 'selected'; } ?> >Vermont</option>
					<option value="VA" <?php if($state == 'VA'){ echo 'selected'; } ?> >Virginia</option>
					<option value="WA" <?php if($state == 'WA'){ echo 'selected'; } ?> >Washington</option>
					<option value="WV" <?php if($state == 'WV'){ echo 'selected'; } ?> >West Virginia</option>
					<option value="WI" <?php if($state == 'WI'){ echo 'selected'; } ?> >Wisconsin</option>
					<option value="WY" <?php if($state == 'WY'){ echo 'selected'; } ?> >Wyoming</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<label for="zip" class="sr-only">Zip *</label>
			<div class="input-group mb-2 <?php echo ( $zip=='' && $formSubmitted ? 'has-danger' : ''); ?>">
				<input name="zip" type="text" id="zip" class="textbox form-control <?php echo ( $zip=='' && $formSubmitted ? 'form-control-danger' : ''); ?>" value="<?php echo (!$passCheck && $zip != '' ? $zip : ''); ?>" required placeholder="Zip *">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<label for="additional_info" class="sr-only">Message</label>
				<textarea name="additional_info" rows="4" class="form-control" placeholder="Message" style="height: 130px;"><?php echo (!$passCheck && $message != '' ? stripslashes($message) : ''); ?></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<input type="text" name="secu" style="position: absolute; height: 1px; top: -50px; left: -50px; width: 1px; padding: 0; margin: 0; visibility: hidden;" >
				<button type="submit" class="btn btn-primary btn-md mb-2" >Submit Application</button>
			</div>
		</div>
	</div>
