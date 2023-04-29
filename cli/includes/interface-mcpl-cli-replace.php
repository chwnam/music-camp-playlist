<?php
if ( ! interface_exists( 'MCPL_CLI_Replace' ) ) {
	interface MCPL_CLI_Replace {
		public function replace( string $content ): string;
	}
}
