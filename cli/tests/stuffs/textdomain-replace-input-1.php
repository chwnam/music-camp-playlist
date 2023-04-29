<?php

class MCPL_Textdomain_Test {
	public function test(): string {
		return __( 'MCPL Textdomain Test', 'mcpl' );
	}
}

$mcpl_textdomain_test = new MCPL_Textdomain_Test();
?>

<div title="<?php esc_attr_e( 'Div title', 'mcpl' ); ?>">
	<?php _e( 'String', 'mcpl' ); ?>
	<?php
	$string1 = _n( 'single', 'plural', 2, 'mcpl' );
	$string2 = _nx( 'single', 'plural', 2, 'context', 'mcpl' );
	$string3 = _x( 'string', 'context', 'mcpl' );
	$string4 = __( 'mcpl' ); // This is textdomain test. This one should not be replaced by the test.
	?>
</div>
