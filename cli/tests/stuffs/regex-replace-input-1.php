<?php
/**
 * File for slug change testing.
 *
 * Upper slug: MCPL, for class, interface, trait names.
 * Lower slug: mcpl, for variable, method names.
 *
 * Sluges will be replaced only if they are used as whole words.
 * e.g. Replaced: MCPL, mcpl, MCPL-Foo, MCPL_Foo, Foo-MCPL, Foo_MCPL, mcpl-foo, mcpl_foo, get_mcpl, get_mcpl_some
 *      Ignored:  NBPCFoo, FooNBPC, nbpcfoo, foonbpc
 */

if ( ! interface_exists( 'MCPL_ID_Interface' ) ) {
	interface MCPL_ID_Interface {
		public function get_id(): int;
	}
}

if ( ! interface_exists( 'MCPL_Minor_Interface' ) ) {
	interface MCPL_Minor_Interface {
		public function do_minor_thing();
	}
}

if ( ! interface_exists( 'MCPL_Side_Interface' ) ) {
	interface MCPL_Side_Interface {
		public function do_side_thing();
	}
}

if ( ! interface_exists( 'MCPL_Major_Interface' ) ) {
	interface MCPL_Major_Interface extends MCPL_Minor_Interface, MCPL_ID_Interface {
		public function do_major_thing();
	}
}

if ( ! class_exists( 'MCPL_Major_Impl' ) ) {
	class MCPL_Major_Impl implements MCPL_Major_Interface {
		public function __construct( public int $id ) {
		}

		public function do_minor_thing() {
			echo "Minor\n";
		}

		public function do_major_thing() {
			echo "Major: {$this->get_id()}\n";
		}

		public function get_id(): int {
			return $this->id;
		}
	}
}

if ( ! class_exists( 'MCPL_Side_Impl' ) ) {
	class MCPL_Side_Impl implements MCPL_Side_Interface, MCPL_ID_Interface {
		public function __construct( public int $id ) {
		}

		public function do_side_thing() {
			echo "Side: {$this->get_id()}\n";
		}

		public function get_id(): int {
			return $this->id;
		}
	}
}

if ( ! trait_exists( 'MCPL_Extraction_Trait' ) ) {
	trait MCPL_Extraction_Trait {
		protected string $trait_value;

		public function mcpl_get_trait_value(): string {
			return $this->trait_value;
		}
	}
}

if ( ! class_exists( 'MCPL_Extraction_Base ' ) ) {
	abstract class MCPL_Extraction_Base {
		abstract protected function get_extractions(): array;
	}
}

if ( ! class_exists( 'MCPL_Extraction_Input_1' ) ) {
	/**
	 * MCPL_Extraction_Input_1
	 *
	 * Lower slug: mcpl
	 * Upper slug: MCPL
	 */
	class MCPL_Extraction_Input_1 extends MCPL_Extraction_Base implements MCPL_Major_Interface, MCPL_Side_Interface {
		use MCPL_Extraction_Trait;

		public const EXT = 'mcpl_ext';

		private array $mcpl_doubled;

		private array $mcpl_tripled;

		private array $mcpl_quadrupled;

		private MCPL_Major_Interface $major;

		private MCPL_Side_Interface $side;

		public function __construct( MCPL_Major_Interface $major, MCPL_Side_Interface $side ) {
			$this->major = $major;
			$this->side  = $side;

			$this->mcpl_doubled = array_map(
				[ $this, 'mcpl_make_double' ],
				[ __CLASS__, 'mcpl_get_basic_array' ]
			);

			$this->mcpl_tripled = array_map(
				function ( $value ) { return mcpl_get_three() * $value; },
				[ __CLASS__, 'mcpl_get_basic_array' ]
			);

			$this->mcpl_quadrupled = array_map(
				fn( $value ) => mcpl_get_four() * $value,
				[ $this, 'mcpl_get_basic_array' ]
			);

			$this->trait_value = static::EXT;
		}

		public function do_minor_thing() {
			$this->major->do_minor_thing();
		}

		public function do_major_thing() {
			$this->major->do_major_thing();
		}

		public function do_side_thing() {
			$this->side->do_side_thing();
		}

		public function get_extractions(): array {
			return [
				MCPL_Extraction_Input_1::class,
				MCPL_Minor_Interface::class,
				MCPL_Side_Interface::class,
			];
		}

		public function get_mcpl_items(): string {
			return implode( ', ', [ ...$this->mcpl_doubled, ...$this->mcpl_tripled, ...$this->mcpl_quadrupled ] );
		}

		public function mcpl_make_double( int $value ): int {
			return mcpl_get_two() * $value;
		}

		public function create_another(): MCPL_Extraction_Input_1 {
			return new MCPL_Extraction_Input_1(
				new MCPL_Major_Impl( $this->get_major()->get_id() + 1 ),
				new MCPL_Side_Impl( $this->get_side()->get_id() + 1 )
			);
		}

		public function get_major(): MCPL_Major_Interface {
			return $this->major;
		}

		public function set_major( MCPL_Major_Interface $major ) {
			$this->major = $major;
		}

		public function get_side(): MCPL_Side_Interface {
			return $this->side;
		}

		public function set_side( MCPL_Side_Interface $side ) {
			$this->side = $side;
		}

		public function get_id(): int {
			return $this->major->get_id();
		}

		public static function mcpl_get_basic_array(): array {
			return [ 1, 2, 3 ];
		}
	}
}

if ( ! function_exists( 'mcpl_get_two' ) ) {
	function mcpl_get_two(): int {
		return 2;
	}
}

if ( ! function_exists( 'mcpl_get_three' ) ) {
	function mcpl_get_three(): int {
		return 3;
	}
}

if ( ! function_exists( 'mcpl_get_four' ) ) {
	function mcpl_get_four(): int {
		return 4;
	}
}

if ( ! function_exists( 'mcpl_double_major' ) ) {
	function mcpl_double_major( MCPL_Major_Interface $major ): MCPL_Major_Impl {
		return new MCPL_Major_Impl( $major->get_id() * mcpl_get_two() );
	}
}

if ( ! function_exists( 'mcpl_create_side' ) ) {
	function mcpl_create_side( int $id ): MCPL_Side_Impl {
		return new MCPL_Side_Impl( $id );
	}
}

if ( ! function_exists( 'nbpcfoo' ) ) {
	// Intentionally testing wrong slug.
	function nbpcfoo(): void {
	}
}

// Commnet and mcpl.
esc_html_e( MCPL_Extraction_Input_1::EXT, 'mcpl' );

// Do silly things, just for testing.
$mcpl_major = new MCPL_Major_Impl( 1 );
$mcpl_side  = new MCPL_Side_Impl( 1 );

// Comment and MCPL.
$ex1 = new MCPL_Extraction_Input_1( $mcpl_major, $mcpl_side );
echo $ex1->get_mcpl_items();

# Command and MCPL.
$ex2 = $ex1->create_another();

$ex1->set_major( mcpl_double_major( $ex2->get_major() ) );
$ex1->set_side( mcpl_create_side( 10 ) );

printf(
	'<a href="%s" title="%s">%s</a">',
	esc_url( get_home_url() ),
	esc_attr( __( 'Link for test', 'mcpl' ) ),
	esc_html( _n( 'A Link', 'Links', 2, 'mcpl' ) . ' ' )
);
?>

    <p><?php echo esc_html( $ex1->mcpl_get_trait_value() ); ?><p>

<?php

$arr_mcpl = MCPL_Extraction_Input_1::mcpl_get_basic_array();
echo esc_html( $arr_mcpl[1] );
