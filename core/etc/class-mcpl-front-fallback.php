<?php
/**
 * Naran Boilerplate Core
 *
 * etc/class-mcpl-front-fallback.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MCPL_Front_Fallback' ) ) {
	class MCPL_Front_Fallback implements MCPL_Front_Module {
		use MCPL_Template_Impl;

		public function display(): void {
			?>
            <style>
                #mcpl-fallback-wide {
                    width: 100%;
                    background-color: #eee;
                    font-family: "Ubuntu Mono", monospace;
                    font-size: 12pt;
                    color: #191919;
                    margin-top: 50px;
                    margin-bottom: 50px;
                }

                #mcpl-fallback-wide .mcpl-fallback-container {
                    width: 640px;
                    margin: 0 auto 0;
                    padding: 20px 10px 20px;
                    background-color: #ddd;
                }

                #mcpl-fallback-wide .mcpl-fallback-title {
                    width: 100%;
                    text-align: center;
                }

                #mcpl-fallback-wide .mcpl-fallback-instruction pre.bold {
                    display: inline-block;
                    background-color: #b3b3b3;
                    font-weight: bold;
                }

                #mcpl-fallback-wide pre,
                #mcpl-fallback-wide code {
                    font-family: "Ubuntu Mono", monospace;
                    font-size: 10pt;
                }

                #mcpl-fallback-wide pre.code {
                    background-color: #aaa;
                    padding: 10px 15px;
                    margin-right: 35px;
                }

            </style>

            <div id="mcpl-fallback-wide">
                <div class="mcpl-fallback-container">
                    <h1 class="mcpl-fallback-title">Fallback template</h1>
                    <p>
                        Front module is not properly set up. Please follow the instructions below:
                    </p>
                    <ol class="mcpl-fallback-instruction">
                        <li>Open
                            <pre class="bold">`class-mcpl-register-theme-support.php`</pre>
                            file.
                        </li>
                        <li>Search for
                            <pre class="bold">`MCPL_Register_Theme_Support::map_front_modules()`</pre>
                            method.
                        </li>
                        <li>Set up the front module, like:
                            <pre class="code"><code>public function map_front_modules( WP_Query $query ) {
    if ( ! $query->is_main_query() ) {
        return;
    }

    $this->remove_action( 'pre_get_posts', 'map_front_modules' );

    $hierarchy = MCPL_Theme_Hierarchy::get_instance();

    // Decide which front module will handle the front scene.
    if ( $hierarchy->is_archive() ) {
        $hierarchy->set_front_module( Archive_Front_Module::class );
    } elseif ( $hierarchy->is_singular() ) {
        $hierarchy->set_front_module( Singular_Front_Module::class );
    }
}</code></pre>
                        </li>
                        <li>You can also override the state of your theme hierarchy instance by action
                            <pre class="bold">'mcpl_theme_hierarchy'</pre>.
                            See <pre class="bold">`MCPL_Theme_Hierarchy::__construct()`</pre>.
                        </li>
                    </ol>
                </div>
            </div>
			<?php
		}
	}
} 
