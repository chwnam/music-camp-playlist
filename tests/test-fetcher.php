<?php
/** @noinspection PhpIllegalPsrClassPathInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */

class FetccherTest extends WP_UnitTestCase {
	public function test_fetch_list(): void {
		$fetcher = mcpl()->fetcher;

		$items = $fetcher->fetch_list( 624 );

		$this->assertIsArray( $items );
	}

	public function test_fetch_item(): void {
		$fetcher = mcpl()->fetcher;

		$items = $fetcher->fetch_item( 6236 );

		$this->assertIsArray( $items );
	}
}
