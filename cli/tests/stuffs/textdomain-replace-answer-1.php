<?php

class MCPL_Textdomain_Test {
	public function test(): string {
		return __( 'MCPL Textdomain Test', 'smpl' );
	}
}

$mcpl_textdomain_test = new MCPL_Textdomain_Test();
?>

<div title="<?php esc_attr_e( 'Div title', 'smpl' ); ?>">
	<?php _e( 'String', 'smpl' ); ?>
	<?php
	$string1 = _n( 'single', 'plural', 2, 'smpl' );
	$string2 = _nx( 'single', 'plural', 2, 'context', 'smpl' );
	$string3 = _x( 'string', 'context', 'smpl' );
	$string4 = __( 'mcpl' ); // This is textdomain test. This one should not be replaced by the test.
	?>
</div>
