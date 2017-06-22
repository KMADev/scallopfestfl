
<div class="row justify-content-center">
    <div><h3> VIP TENT SPONSOR </h3></div>
</div>
<div class="row justify-content-center">
	<?php
	$sponsors = Sponsor::getSponsorByLevel( 'VIP Tent Sponsor' );
	foreach ( $sponsors as $sponsor ) {
		$logo = Sponsor::getLogoUrl( $sponsor->ID );
		$url  = Sponsor::getCompanyUrl( $sponsor->ID );
		echo '<div><a href="' . $url . '"><img src="' . $logo . '"></a></div>';

	}
	?>
</div>
<div class="row justify-content-center">
    <div><h3>PLATINUM PLUS SPONSORS</h3></div>
</div>
<div class="row justify-content-center">
	<?php
	$sponsors = Sponsor::getSponsorByLevel( 'Platinum Plus Sponsor' );
	foreach ( $sponsors as $sponsor ) {
		$logo = Sponsor::getLogoUrl( $sponsor->ID );
		$url  = Sponsor::getCompanyUrl( $sponsor->ID );
		echo '<div class="col"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

	}
	?>
</div>
<div class="row justify-content-center">
    <div><h3>GOLD LEVEL SPONSORS</h3></div>
</div>
<div class="row justify-content-center">
	<?php
	$sponsors = Sponsor::getSponsorByLevel( 'Gold Level Sponsor' );
	foreach ( $sponsors as $sponsor ) {
		$logo = Sponsor::getLogoUrl( $sponsor->ID );
		$url  = Sponsor::getCompanyUrl( $sponsor->ID );
		echo '<div class="col-md-3"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

	}
	?>
</div>
<div class="row justify-content-center">
    <div><h3>SILVER LEVEL SPONSORS</h3></div>
</div>
<div class="row justify-content-center">
	<?php
	$sponsors = Sponsor::getSponsorByLevel( 'Silver Level Sponsor' );
	foreach ( $sponsors as $sponsor ) {
		$logo = Sponsor::getLogoUrl( $sponsor->ID );
		$url  = Sponsor::getCompanyUrl( $sponsor->ID );
		echo '<div class="col-md-3"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

	}
	?>
</div>
<div class="row justify-content-center">
    <div><h3>BRONZE LEVEL SPONSORS</h3></div>
</div>
<div class="row justify-content-center">
	<?php
	$sponsors = Sponsor::getSponsorByLevel( 'Bronze Level Sponsor' );
	foreach ( $sponsors as $sponsor ) {
		$logo = Sponsor::getLogoUrl( $sponsor->ID );
		$url  = Sponsor::getCompanyUrl( $sponsor->ID );
		echo '<div class="col-md-3"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

	}
	?>
</div>

