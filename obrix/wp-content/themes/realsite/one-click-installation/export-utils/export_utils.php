<?php

require_once 'export_utils.wl.php'; //widget logic
require_once 'export_utils.to.php'; //theme options

add_action( 'init', 'aviators_utils_rewrite_rules', 99999 );

function aviators_utils_rewrite_rules() {
    add_rewrite_rule('^aviators-utils/(.+)/?$', 'index.php?aviators-utils=true&export=$matches[1]', 'top');
    flush_rewrite_rules();
}

add_filter('query_vars', 'aviators_utils_add_query_vars');
function aviators_utils_add_query_vars($vars) {
    $vars[] = 'aviators-utils';
    $vars[] = 'export';
    return $vars;
}

add_action('template_redirect', 'aviators_utils_catch_template');
function aviators_utils_catch_template() {

    if (get_query_var('aviators-utils') && get_query_var('export')) {
        $export = get_query_var('export');

        if($export == 'theme-options') {
            $exporter = new PMUtilsTOExport();
            $exporter->export();
        }

        if($export == 'widget-logic') {
            $exporter = new PMUtilsWLExport();
            $exporter->export();
        }

        die;
    }
}

add_action('admin_menu', 'aviators_utils_menu');
function aviators_utils_menu() {
    add_management_page(__('Theme Options Export', 'realia'), __('Theme Options Export', 'realia'), 'edit_pages', 'theme-options-export', 'aviators_utils_to_export_page');
    add_management_page(__('Widget Logic Export', 'realia'), __('Widget Logic Export', 'realia'), 'edit_pages', 'widget-logic-export', 'aviators_utils_wl_export_page');
}