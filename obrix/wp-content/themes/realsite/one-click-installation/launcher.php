<?php

require_once 'export-utils/export_utils.php';

$uri = get_template_directory_uri() . '/one-click-installation';

define ('AVIATORS_LAUNCHER_URI', $uri );
define ('AVIATORS_LAUNCHER_PATH', dirname(__FILE__));

function aviators_launcher_steps() {
    $steps = array();
    $steps = apply_filters('aviators_launcher_steps', $steps);

    return $steps;
}

function aviators_launcher_define_importers($definitions) {
    $definitions['content'] = array(
        'title' => __('Demo Content', 'realia'),
        'class' => 'PMLauncherContentImport',
        'file' => dirname(__FILE__) . '/importers/content-import.php',
    );

    $definitions['theme-options'] = array(
        'title' => __('Theme Options', 'realia'),
        'class' => 'PMLauncherThemeOptionsImport',
        'file' => dirname(__FILE__) . '/importers/theme-options-import.php',
    );

    $definitions['widget-settings'] = array(
        'title' => __('Widget Data', 'realia'),
        'class' => 'PMLauncherWidgetSettingsImport',
        'file' => dirname(__FILE__) . '/importers/widget-import.php',
    );

    $definitions['widget-logic'] = array(
        'title' => __('Widget Logic', 'realia'),
        'class' => 'PMLauncherWidgetLogicImport',
        'file' => dirname(__FILE__) . '/importers/logic-import.php',
    );

    $definitions['rev-slider'] = array(
        'title' => __('Revolution Slider', 'realia'),
        'class' => 'PMLauncherRevSliderImport',
        'file' => dirname(__FILE__) . '/importers/rev-slider-import.php',
    );

    return $definitions;
}

add_filter('aviators_launcher_define_importers', 'aviators_launcher_define_importers');

function aviators_launcher_required_plugins() {
    $plugins = array (
        array (
            'title' => 'Widget Logic',
            'url'   => 'https://wordpress.org/plugins/widget-logic/',
            'path'  => 'widget-logic/widget_logic.php',
        ),
        array (
            'title' => 'Wordpress Importer',
            'url'   => 'https://wordpress.org/plugins/wordpress-importer/',
            'path'  => 'wordpress-importer/wordpress-importer.php',
        ),
        array (
            'title' => 'Widget Settings Importer/Exporter',
            'url'   => 'https://wordpress.org/plugins/widget-settings-importexport/',
            'path'  => 'widget-settings-importexport/widget-data.php',
        ),
    );

    return $plugins;
}

function aviators_launcher_has_inactive_plugins() {
    $required_plugins = aviators_launcher_required_plugins();
    $inactive_plugins = false;

    foreach( $required_plugins as $required_plugin ) {
        if( !is_plugin_active( $required_plugin['path'] ) ) {
            $inactive_plugins[] = $required_plugin;
        }
    }

    return $inactive_plugins;
}

add_action( 'init', 'aviators_launcher_init' );

function aviators_launcher_init() {    
    $launcher = new PMLauncher();

	if ( ! empty( $_GET['step'] ) ) {
		if ( ! empty( $_GET['action'] ) && $_GET['action'] == 'process' ) {
			$launcher->processStep( $_GET['step'] );
			die;
		} elseif ( ! empty( $_GET['action'] ) && $_GET['action'] == 'report' ) {
			$launcher->report( $_GET['step'] );
			die;
		}
	}
}

class PMLauncher {
    function __construct() {
        add_action('admin_menu', array($this, 'registerMenu'));
    }

    public function registerMenu($defaultItem) {
        add_menu_page( __('One-Click Install', 'realia'), __('One-Click Install', 'realia'), 'edit_pages', 'launcher', array( $this, 'page', ), 'dashicons-hammer', 52);
        return true;
    }

    function page() {        
        $steps = aviators_launcher_steps();
        $step_ids = implode(',', array_keys($steps));
        include 'template/launcher.php';
    }

    function processStep($step) {
        $stepsDefinitions = aviators_launcher_steps();
        $stepDefinition = $stepsDefinitions[$step];

        $importerDefinitions = $this->definitions();
        $importerDefinition = $importerDefinitions[$stepDefinition['importer']];

        // require importer file        
        require_once($importerDefinition['file']);        
        // pass file path to import
        $class = new ReflectionClass($importerDefinition['class']);
        $instance = $class->newInstanceArgs(array());

        $messages = $instance->process($stepDefinition['file']);
        $_SESSION['pm-launcher-report'][$step] = $messages;
    }

    function report($step) {        
        $stepsDefinitions = aviators_launcher_steps();
        $stepDefinition = $stepsDefinitions[$step];

        $importerDefinitions = $this->definitions();
        $importerDefinition = $importerDefinitions[$stepDefinition['importer']];

        // require importer file        
        require_once($importerDefinition['file']);
        // pass file path to import
        $class = new ReflectionClass($importerDefinition['class']);
        $instance = $class->newInstanceArgs(array());

        if ( ! empty( $_SESSION['pm-launcher-report'][$step] ) ) {
            $messages = $_SESSION['pm-launcher-report'][$step];
            echo wp_kses( $instance->report( $messages ), wp_kses_allowed_html( 'post' ) );
            unset($_SESSION['pm-launcher-report'][$step]);
        }        
    }

    function definitions() {
        $definitions = array();
        $definitions = apply_filters('aviators_launcher_define_importers', $definitions);
        return $definitions;
    }
}

interface PMLauncherImporter {
    function process($filepath);
    function report($data);
}
