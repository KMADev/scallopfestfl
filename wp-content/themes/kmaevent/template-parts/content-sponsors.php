
<h2 class="text-center vip">VIP TENT SPONSOR </h2>
<div class="logo-container">
    <div class="row justify-content-center align-items-center">
        <?php
        $sponsors = Sponsor::getSponsorByLevel( 'VIP Tent Sponsor' );
        foreach ( $sponsors as $sponsor ) {
            $logo = Sponsor::getLogoUrl( $sponsor->ID );
            $url  = Sponsor::getCompanyUrl( $sponsor->ID );
            echo '<div><a href="' . $url . '"><img src="' . $logo . '"></a></div>';

        }
        ?>
    </div>
</div>
<h2 class="text-center platinum">PLATINUM PLUS SPONSORS</h2>
<div class="logo-container">
    <div class="row justify-content-center align-items-center">
        <?php
        $sponsors = Sponsor::getSponsorByLevel( 'Platinum Plus Sponsor' );
        foreach ( $sponsors as $sponsor ) {
            $logo = Sponsor::getLogoUrl( $sponsor->ID );
            $url  = Sponsor::getCompanyUrl( $sponsor->ID );
            echo '<div class="col"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

        }
        ?>
    </div>
</div>
<h2 class="text-center gold">GOLD LEVEL SPONSORS</h2>
<div class="logo-container">
    <div class="row justify-content-center align-items-center">
        <?php
        $sponsors = Sponsor::getSponsorByLevel( 'Gold Level Sponsor' );
        foreach ( $sponsors as $sponsor ) {
            $logo = Sponsor::getLogoUrl( $sponsor->ID );
            $url  = Sponsor::getCompanyUrl( $sponsor->ID );
            echo '<div class="col-md-3"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

        }
        ?>
    </div>
</div>
<h2 class="text-center silver">SILVER LEVEL SPONSORS</h2>
<div class="logo-container">
    <div class="row justify-content-center align-items-center">
        <?php
        $sponsors = Sponsor::getSponsorByLevel( 'Silver Level Sponsor' );
        foreach ( $sponsors as $sponsor ) {
            $logo = Sponsor::getLogoUrl( $sponsor->ID );
            $url  = Sponsor::getCompanyUrl( $sponsor->ID );
            echo '<div class="col-md-3"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

        }
        ?>
    </div>
</div>
<h2 class="text-center bronze">BRONZE LEVEL SPONSORS</h2>
<div class="logo-container">
    <div class="row justify-content-center align-items-center">
        <?php
        $sponsors = Sponsor::getSponsorByLevel( 'Bronze Level Sponsor' );
        foreach ( $sponsors as $sponsor ) {
            $logo = Sponsor::getLogoUrl( $sponsor->ID );
            $url  = Sponsor::getCompanyUrl( $sponsor->ID );
            echo '<div class="col-md-3"><a href="' . $url . '"><img src="' . $logo . '" class="img img-fluid"></a></div>';

        }
        ?>
    </div>
</div>
