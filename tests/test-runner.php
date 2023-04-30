<?php
/** @noinspection PhpIllegalPsrClassPathInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */

class RunnerTest extends WP_UnitTestCase {
	public function test_fetch_page(): void {
		$runner = mcpl()->runner;

		$runner->fetch_page( 1 );
	}
}
