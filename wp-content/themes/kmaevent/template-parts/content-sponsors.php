<?php

$sponsors = Sponsor::getSponsorByLevel( 'Presenting Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">PRESENTING SPONSOR </h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>

<?php } ?>

<?php

$sponsors = Sponsor::getSponsorByLevel( 'Stage Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">STAGE SPONSOR </h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>

<?php } ?>

<?php
$sponsors = Sponsor::getSponsorByLevel( 'VIP Tent Sponsor' );
if ( count( $sponsors ) > 0 ) {
	?>
    <h2 class="text-center vip">VIP TENT SPONSORS </h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			$sponsors = Sponsor::getSponsorByLevel( 'VIP Tent Sponsor' );
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>
<?php } ?>
<?php

$sponsors = Sponsor::getSponsorByLevel( 'Beer Tent Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">BEER TENT SPONSORS </h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>

<?php } ?>

<?php

$sponsors = Sponsor::getSponsorByLevel( 'Air Conditioned Bathroom Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">AIR CONDITIONED BATHROOM SPONSORS </h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>

<?php } ?>

<?php

$sponsors = Sponsor::getSponsorByLevel( 'Platinum Plus Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">PLATINUM PLUS SPONSORS</h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col-md-6 mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>

<?php } ?>

<?php
$sponsors = Sponsor::getSponsorByLevel( 'Gold Level Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">GOLD LEVEL SPONSORS</h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col-md-3 mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>
<?php } ?>
<?php
$sponsors = Sponsor::getSponsorByLevel( 'Silver Level Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">SILVER LEVEL SPONSORS</h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col-md-3 mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>
<?php } ?>

<?php
$sponsors = Sponsor::getSponsorByLevel( 'Bronze Level Sponsor' );
if ( count( $sponsors ) > 0 ) { ?>

    <h2 class="text-center vip">BRONZE LEVEL SPONSORS</h2>
    <div class="logo-container">
        <div class="row justify-content-center align-items-center">
			<?php
			foreach ( $sponsors as $sponsor ) {
				$logo = Sponsor::getLogoUrl( $sponsor->ID );
				$url  = Sponsor::getCompanyUrl( $sponsor->ID );
				echo '<div class="col mb-2 text-center"><a href="' . $url . '" target="_blank"><img src="' . $logo . '" class="img img-fluid"></a></div>';

			}
			?>
        </div>
    </div>
<?php } ?>

