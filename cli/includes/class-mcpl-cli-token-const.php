<?php

if ( ! class_exists( 'MCPL_CLI_Token_Const' ) ) {
	class MCPL_CLI_Token_Const {
		public function __construct(
			public MCPL_CLI_Token $name,
			public MCPL_CLI_Token $value,
		) {
		}
	}
}