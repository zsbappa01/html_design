<?php

class PMLauncherWidgetSettingsImport implements PMLauncherImporter {

    public function process($filepath) {
        require_once ABSPATH . '/wp-content/plugins/widget-settings-importexport/widget-data.php';
        $json = file_get_contents($filepath);
        $json_array = json_decode($json, TRUE);

        list($sidebars, $widgets) = ($json_array);

//        $nav_menus = array_search('nav_menu', $json_array);
//        $wp_nav_menus = wp_get_nav_menus();
//
//        foreach ($nav_menus as $nav_menu) {
//            foreach ( $wp_nav_menus as $wp_nav_menu ) {
//                if ( $nav_menu['title'] == $wp_nav_menu['name'] ) {
//                    $nav_menu['nav_menu'] = $wp_nav_menu['slug'];
//                }
//            }
//        }

        update_option('sidebars_widgets', $sidebars);
        foreach($widgets as $widgetID => $widgetOptions) {
            update_option('widget_' . $widgetID, $widgetOptions);
        }

        foreach ($sidebars as $sidebar_name=>$sidebar_content) {
            $output[] = $sidebar_name . ': ' . implode(", ", $sidebar_content);
        }

        $messages = $output;
        return $messages;
    }

    public function report($messages) {
        include AVIATORS_LAUNCHER_PATH . '/template/messages.php';
    }
}