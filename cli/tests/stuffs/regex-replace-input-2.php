<?php
namespace Naran\MCPL\CLI;

use Naran\MCPL\Core as MCPL_Core;
use function MCPL_Foo\Bar\func as mcpl_func;

function mcpl_foo_x( int|string|array $foo ): int|string|array|MCPL_Foo {
	return $foo;
}
