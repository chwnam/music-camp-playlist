<?php
/** @noinspection PhpIllegalPsrClassPathInspection */
/** @noinspection PhpMultipleClassDeclarationsInspection */

class RunnerTest extends WP_UnitTestCase {
	public function test_incremental_fetch(): void {
		$runner = mcpl()->runner;

		$runner->incremental_fetch();
	}
}
