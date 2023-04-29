<?php

if ( ! function_exists( 'mcpl_cli_the_slug' ) ) {
	function mcpl_cli_the_slug(): string {
		return THE_SLUG;
	}
}

if ( ! function_exists( 'mcpl_cli_the_guls' ) ) {
	function mcpl_cli_the_guls(): string {
		return THE_GULS;
	}
}

if ( ! function_exists( 'mcpl_cli_basename' ) ) {
	function mcpl_cli_basename( string $path, string $suffix = '' ): string {
		return urldecode( basename( str_replace( [ '%2F', '%5C' ], '/', urlencode( $path ) ), $suffix ) );
	}
}

if ( ! function_exists( 'mcpl_cli_prompt' ) ) {
	function mcpl_cli_prompt( string $message = '' ): string {
		fwrite( STDOUT, $message . ' ' );
		return trim( fgets( STDIN ) );
	}
}

if ( ! function_exists( 'mcpl_cli_confirm' ) ) {
	function mcpl_cli_confirm( string $message ): bool {
		return 'y' === mcpl_cli_prompt( $message . ' [y/n] ' );
	}
}

if ( ! function_exists( 'mcpl_cli_lower_slug' ) ) {
	function mcpl_cli_lower_slug( string $input ): string {
		return strtolower( $input );
	}
}

if ( ! function_exists( 'mcpl_cli_upper_slug' ) ) {
	function mcpl_cli_upper_slug( string $input ): string {
		return strtoupper( str_replace( '-', '_', $input ) );
	}
}

if ( ! function_exists( 'mcpl_cli_update_dot_slug' ) ) {
	function mcpl_cli_update_dot_slug( array $content ): void {
		file_put_contents( MCPL_ROOT . '/.slug.json', json_encode( $content ) );
	}
}

if ( ! function_exists( 'mcpl_cli_get_dot_slug' ) ) {
	function mcpl_cli_get_dot_slug(): array {
		$info = '';

		if ( file_exists( MCPL_ROOT . '/.slug.json' ) ) {
			$info = file_get_contents( MCPL_ROOT . '/.slug.json' );
		}

		return json_decode( $info, true ) ?: [];
	}
}


if ( ! function_exists( 'nbp_cil_glob' ) ) {
	function mcpl_cli_glob( string $pattern, int $flags = 0 ): array {
		if ( false === stripos( $pattern, '**' ) ) {
			return glob( $pattern, $flags );
		}

		$position     = stripos( $pattern, '**' );
		$root_pattern = substr( $pattern, 0, $position - 1 );
		$rest_pattern = substr( $pattern, $position + 2 );

		$patterns     = [ $root_pattern . $rest_pattern ];
		$root_pattern .= '/*';

		while ( $dirs = glob( $root_pattern, GLOB_ONLYDIR ) ) {
			$root_pattern .= '/*';
			foreach ( $dirs as $dir ) {
				$patterns[] = $dir . $rest_pattern;
			}
		}

		$files = [];

		foreach ( $patterns as $pat ) {
			$f     = mcpl_cli_glob( $pat, $flags );
			$files = [ ... $files, ...$f ];
		}

		$files = array_unique( array_filter( $files ) );

		sort( $files );

		return $files;
	}
}
