<?php

//if ( ! function_exists( '' ) ) {
//	function foo() {
//	}
//}

if ( ! function_exists( 'mcpl_validate_date' ) ) {
	function mcpl_validate_date( $value ): bool {
		$match = preg_match( '/\d{4}-\d{2}-\d{2}/', $value );
		$date  = date_create_immutable( $value );

		return $match && $date;
	}
}
