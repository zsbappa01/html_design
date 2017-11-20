<?php

/**
 * Simple Widget Logic Export Page
 */
function aviators_utils_wl_export_page() {
    $wl = new PMUtilsWLExport();
    $wl->render();
}

/**
 * Class UtilsWLExport
 * Widget Logic Export Class
 */
class PMUtilsWLExport {

    public function __construct() {

    }

    public function render() {
        $link = home_url() . '/aviators-utils/widget-logic';

        echo "<div class='wrap'>";
        echo "<h2>" . __('Export Widget Logic settings', 'realetate') . "</h2>";
        echo "<p>" . __('Click the button below to download JSON file with Widget Logic settings.', 'realia') . "</p>";
        echo "<p class='submit'><a href=\"$link\" class='button button-primary'>" . __('Download Export File', 'realetate') . "</a>";
        echo "</div>";

    }

    public function export() {
        $this->downloadHeaders();
        $widget_logic = get_option('widget_logic');
        echo json_encode($widget_logic);
    }

    public function downloadHeaders() {
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename=widget_logic.json");
        header("Content-Transfer-Encoding: binary");
    }
}