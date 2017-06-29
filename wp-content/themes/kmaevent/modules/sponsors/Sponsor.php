<?php

class Sponsor {

	/**
	 * Returns array sponsors based on sponsorship level
	 * @param $level
	 *
	 * @return array
	 */
	public static function getSponsorByLevel( $level ) {
		$request = array(
			'post_type'         => 'sponsor',
			'posts_per_page'    => - 1,
			'orderby'           => 'menu_order',
			'order'             => 'ASC',
			'offset'            => 0,
			'post_status'       => 'publish',
			'sponsorship_level' => $level
		);

		$allSponsors = get_posts( $request );

		return $allSponsors;
	}

	/**
	 * Fetches url for logo based on sponsor ID
	 * @param $sponsorId
	 *
	 * @return mixed
	 */
	public static function getLogoUrl( $sponsorId ) {

		return get_post_meta($sponsorId, 'sponsor_information_logo', true);
	}

	/**
	 * Fetches company url based on sponsor ID
	 * @param $sponsorId
	 *
	 * @return mixed
	 */
	public static function getCompanyUrl( $sponsorId ) {

		return get_post_meta($sponsorId, 'sponsor_information_company_website', true);
	}
}