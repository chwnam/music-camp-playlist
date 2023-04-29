<?php
use PhpParser\NodeVisitor;

if ( ! interface_exists( 'MCPL_CLI_Node_Visitor' ) ) {
	interface MCPL_CLI_Node_Visitor extends NodeVisitor {
		public function get_tokens(): array;
	}
}
