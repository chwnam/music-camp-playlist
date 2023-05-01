<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'MCPL_Admin' => $baseDir . '/includes/modules/class-mcpl-admin.php',
    'MCPL_Admin_Module' => $baseDir . '/core/interfaces/interface-mcpl-admin-module.php',
    'MCPL_Admin_Page' => $baseDir . '/includes/modules/admin/class-mcpl-admin-page.php',
    'MCPL_Admin_Post' => $baseDir . '/includes/modules/admin/class-mcpl-admin-post.php',
    'MCPL_Autobind_Impl' => $baseDir . '/core/traits/trait-mcpl-autobind-impl.php',
    'MCPL_CLI' => $baseDir . '/includes/modules/class-mcpl-cli.php',
    'MCPL_Callback_Exception' => $baseDir . '/core/exceptions/class-mcpl-callback-exception.php',
    'MCPL_EJS_Queue' => $baseDir . '/core/etc/class-mcpl-ejs-queue.php',
    'MCPL_Fetcher' => $baseDir . '/includes/modules/class-mcpl-fetcher.php',
    'MCPL_Front_Archive_Module' => $baseDir . '/core/interfaces/interface-mcpl-front-archive-module.php',
    'MCPL_Front_Fallback' => $baseDir . '/core/etc/class-mcpl-front-fallback.php',
    'MCPL_Front_Module' => $baseDir . '/core/interfaces/interface-mcpl-front-module.php',
    'MCPL_Front_Single_Module' => $baseDir . '/core/interfaces/interface-mcpl-front-single-module.php',
    'MCPL_HTML' => $baseDir . '/core/etc/class-mcpl-html.php',
    'MCPL_Hook_Impl' => $baseDir . '/core/traits/trait-mcpl-hook-impl.php',
    'MCPL_Main' => $baseDir . '/includes/class-mcpl-main.php',
    'MCPL_Main_Base' => $baseDir . '/core/class-mcpl-main-base.php',
    'MCPL_Module' => $baseDir . '/core/interfaces/interface-mcpl-module.php',
    'MCPL_Object' => $baseDir . '/includes/interfaces/interface-mcpl-object.php',
    'MCPL_Object_Artist' => $baseDir . '/includes/objects/class-mcpl-object-artist.php',
    'MCPL_Object_History' => $baseDir . '/includes/objects/class-mcpl-object-history.php',
    'MCPL_Object_Playlist' => $baseDir . '/includes/objects/class-mcpl-object-playlist.php',
    'MCPL_Object_Playlist_Query' => $baseDir . '/includes/objects/class-mcpl-object-track-query.php',
    'MCPL_Object_Query_Trait' => $baseDir . '/includes/traits/trait-mpcl-query-trait.php',
    'MCPL_Object_Track' => $baseDir . '/includes/objects/class-mcpl-object-track.php',
    'MCPL_REST_Routes' => $baseDir . '/includes/modules/class-mcpl-rest-routes.php',
    'MCPL_Reg' => $baseDir . '/core/interfaces/interface-mcpl-reg.php',
    'MCPL_Reg_AJAX' => $baseDir . '/core/regs/class-mcpl-reg-ajax.php',
    'MCPL_Reg_Activation' => $baseDir . '/core/regs/class-mcpl-reg-activation.php',
    'MCPL_Reg_Block' => $baseDir . '/core/regs/class-mcpl-reg-block.php',
    'MCPL_Reg_Capability' => $baseDir . '/core/regs/class-mcpl-reg-capability.php',
    'MCPL_Reg_Cron' => $baseDir . '/core/regs/class-mcpl-reg-cron.php',
    'MCPL_Reg_Cron_Schedule' => $baseDir . '/core/regs/class-mcpl-reg-cron-schedule.php',
    'MCPL_Reg_Custom_Table' => $baseDir . '/core/regs/class-mcpl-reg-custom-table.php',
    'MCPL_Reg_Deactivation' => $baseDir . '/core/regs/class-mcpl-reg-deactivation.php',
    'MCPL_Reg_Menu' => $baseDir . '/core/regs/class-mcpl-reg-menu.php',
    'MCPL_Reg_Meta' => $baseDir . '/core/regs/class-mcpl-reg-meta.php',
    'MCPL_Reg_Option' => $baseDir . '/core/regs/class-mcpl-reg-option.php',
    'MCPL_Reg_Post_Type' => $baseDir . '/core/regs/class-mcpl-reg-post-type.php',
    'MCPL_Reg_REST_Route' => $baseDir . '/core/regs/class-mcpl-reg-rest-route.php',
    'MCPL_Reg_Rewrite_Rule' => $baseDir . '/core/regs/class-mcpl-reg-rewrite-rule.php',
    'MCPL_Reg_Role' => $baseDir . '/core/regs/class-mcpl-reg-role.php',
    'MCPL_Reg_Script' => $baseDir . '/core/regs/class-mcpl-reg-script.php',
    'MCPL_Reg_Shortcode' => $baseDir . '/core/regs/class-mcpl-reg-shortcode.php',
    'MCPL_Reg_Sidebar' => $baseDir . '/core/regs/class-mcpl-reg-sidebar.php',
    'MCPL_Reg_Style' => $baseDir . '/core/regs/class-mcpl-reg-style.php',
    'MCPL_Reg_Submenu' => $baseDir . '/core/regs/class-mcpl-reg-submenu.php',
    'MCPL_Reg_Submit' => $baseDir . '/core/regs/class-mcpl-reg-submit.php',
    'MCPL_Reg_Taxonomy' => $baseDir . '/core/regs/class-mcpl-reg-taxonomy.php',
    'MCPL_Reg_Theme_Support' => $baseDir . '/core/regs/class-mcpl-reg-theme-support.php',
    'MCPL_Reg_Uninstall' => $baseDir . '/core/regs/class-mcpl-reg-uninstall.php',
    'MCPL_Reg_WP_CLI' => $baseDir . '/core/regs/class-mcpl-reg-wp-cli.php',
    'MCPL_Reg_Widget' => $baseDir . '/core/regs/class-mcpl-reg-widget.php',
    'MCPL_Register' => $baseDir . '/core/interfaces/interface-mcpl-register.php',
    'MCPL_Register_AJAX' => $baseDir . '/includes/registers/class-mcpl-register-ajax.php',
    'MCPL_Register_Activation' => $baseDir . '/includes/registers/class-mcpl-register-activation.php',
    'MCPL_Register_Base_AJAX' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-ajax.php',
    'MCPL_Register_Base_Activation' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-activation.php',
    'MCPL_Register_Base_Block' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-block.php',
    'MCPL_Register_Base_Capability' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-capability.php',
    'MCPL_Register_Base_Cron' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-cron.php',
    'MCPL_Register_Base_Cron_Schedule' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-cron-schedule.php',
    'MCPL_Register_Base_Custom_Table' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-custom-table.php',
    'MCPL_Register_Base_Deactivation' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-deactivation.php',
    'MCPL_Register_Base_Menu' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-menu.php',
    'MCPL_Register_Base_Meta' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-meta.php',
    'MCPL_Register_Base_Option' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-option.php',
    'MCPL_Register_Base_Post_Type' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-post-type.php',
    'MCPL_Register_Base_REST_Route' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-rest-route.php',
    'MCPL_Register_Base_Rewrite_Rule' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-rewrite-rule.php',
    'MCPL_Register_Base_Role' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-role.php',
    'MCPL_Register_Base_Script' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-script.php',
    'MCPL_Register_Base_Shortcode' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-shortcode.php',
    'MCPL_Register_Base_Sidebar' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-sidebar.php',
    'MCPL_Register_Base_Style' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-style.php',
    'MCPL_Register_Base_Submit' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-submit.php',
    'MCPL_Register_Base_Taxonomy' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-taxonomy.php',
    'MCPL_Register_Base_Theme_Support' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-theme-support.php',
    'MCPL_Register_Base_Uninstall' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-uninstall.php',
    'MCPL_Register_Base_WP_CLI' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-wp-cli.php',
    'MCPL_Register_Base_Widget' => $baseDir . '/core/abstracts/registers/abstract-mcpl-register-base-widget.php',
    'MCPL_Register_Block' => $baseDir . '/includes/registers/class-mcpl-register-block.php',
    'MCPL_Register_Capability' => $baseDir . '/includes/registers/class-mcpl-register-capability.php',
    'MCPL_Register_Comment_Meta' => $baseDir . '/includes/registers/class-mcpl-register-comment-meta.php',
    'MCPL_Register_Cron' => $baseDir . '/includes/registers/class-mcpl-register-cron.php',
    'MCPL_Register_Cron_Schedule' => $baseDir . '/includes/registers/class-mcpl-register-cron-schedule.php',
    'MCPL_Register_Custom_Table' => $baseDir . '/includes/registers/class-mcpl-register-custom-table.php',
    'MCPL_Register_Deactivation' => $baseDir . '/includes/registers/class-mcpl-register-deactivation.php',
    'MCPL_Register_Menu' => $baseDir . '/includes/registers/class-mcpl-register-menu.php',
    'MCPL_Register_Option' => $baseDir . '/includes/registers/class-mcpl-register-option.php',
    'MCPL_Register_Post_Meta' => $baseDir . '/includes/registers/class-mcpl-register-post-meta.php',
    'MCPL_Register_Post_Type' => $baseDir . '/includes/registers/class-mcpl-register-post-type.php',
    'MCPL_Register_REST_Route' => $baseDir . '/includes/registers/class-mcpl-register-rest-route.php',
    'MCPL_Register_Rewrite_Rule' => $baseDir . '/includes/registers/class-mcpl-register-rewrite-rule.php',
    'MCPL_Register_Role' => $baseDir . '/includes/registers/class-mcpl-register-role.php',
    'MCPL_Register_Script' => $baseDir . '/includes/registers/class-mcpl-register-script.php',
    'MCPL_Register_Shortcode' => $baseDir . '/includes/registers/class-mcpl-register-shortcode.php',
    'MCPL_Register_Sidebar' => $baseDir . '/includes/registers/class-mcpl-register-sidebar.php',
    'MCPL_Register_Style' => $baseDir . '/includes/registers/class-mcpl-register-style.php',
    'MCPL_Register_Submit' => $baseDir . '/includes/registers/class-mcpl-register-submit.php',
    'MCPL_Register_Taxonomy' => $baseDir . '/includes/registers/class-mcpl-register-taxonomy.php',
    'MCPL_Register_Term_Meta' => $baseDir . '/includes/registers/class-mcpl-register-term-meta.php',
    'MCPL_Register_Theme_Support' => $baseDir . '/includes/registers/class-mcpl-register-theme-support.php',
    'MCPL_Register_Uninstall' => $baseDir . '/includes/registers/class-mcpl-register-uninstall.php',
    'MCPL_Register_User_Meta' => $baseDir . '/includes/registers/class-mcpl-register-user-meta.php',
    'MCPL_Register_WP_CLI' => $baseDir . '/includes/registers/class-mcpl-register-wp-cli.php',
    'MCPL_Register_Widget' => $baseDir . '/includes/registers/class-mcpl-register-widget.php',
    'MCPL_Registers' => $baseDir . '/includes/modules/class-mcpl-registers.php',
    'MCPL_Rewrite_Handlers' => $baseDir . '/includes/modules/class-mcpl-rewrite-handlers.php',
    'MCPL_Runner' => $baseDir . '/includes/modules/class-mcpl-runner.php',
    'MCPL_Script_Helper' => $baseDir . '/core/etc/class-mcpl-script-helper.php',
    'MCPL_Store' => $baseDir . '/includes/modules/class-mcpl-store.php',
    'MCPL_Style_Helper' => $baseDir . '/core/etc/class-mcpl-style-helper.php',
    'MCPL_Submodule_Impl' => $baseDir . '/core/traits/trait-mcpl-submodule-impl.php',
    'MCPL_Template_Impl' => $baseDir . '/core/traits/trait-mcpl-template-impl.php',
    'MCPL_Theme_Hierarchy' => $baseDir . '/core/etc/class-mcpl-theme-hierarchy.php',
);
