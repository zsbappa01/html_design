<?php

/**
 * Simple Widget Logic Export Page
 */
function aviators_utils_to_export_page() {
    $to = new PMUtilsTOExport();
    $to->render();
}

/**
 * Class PMUtilsWLExport
 * Widget Logic Export Class
 */
class PMUtilsTOExport {
    public function __construct() {

    }

    public function render() {
        $link = home_url() . '/aviators-utils/theme-options';

        echo "<div class='wrap'>";
        echo "<h2>" . __('Export Your Theme Options', 'realia') . "</h2>";
        echo "<p>" . __('Click the button below to download JSON file with theme options.', 'realia') . "</p>";
        echo "<p class='submit'><a href=\"$link\" class='button button-primary'>" . __('Download Export File', 'realia') . "</a>";
        echo "</div>";
    }

    public function export() {
        $this->downloadHeaders();

        $options = array('theme_mods_' . strtolower(get_option( 'current_theme' )), 'page_on_front', 'show_on_front', 'page_for_posts', 'blogdescription',
            'blogname');
        $options = apply_filters('aviators_utils_theme_options', $options);

        $exportOptions = array();
        foreach($options as $option) {
            $exportOptions['options'][$option] = get_option($option);
        }

        $menuTerms = get_terms('nav_menu');
        foreach($menuTerms as $term) {
            $exportOptions['menu_associations'][$term->term_id] = $term->slug;
        }

        $associated_posts = get_posts(
            array(
                'post_type' => 'page',
                'posts_per_page' => -1,
                'post__in' => array(get_option('page_on_front'),
                    get_option('page_for_posts'),
                    get_theme_mod('realia_general_compare_page'),
                    get_theme_mod('realia_general_favorites_page'),
                    get_theme_mod('realia_general_login_required_page'),
                    get_theme_mod('realia_general_password_page'),
                    get_theme_mod('realia_general_profile_page'),
                    get_theme_mod('realia_general_under_construction_page'),
                    get_theme_mod('realia_submission_create_page'),
                    get_theme_mod('realia_submission_edit_page'),
                    get_theme_mod('realia_submission_list_page'),
                    get_theme_mod('realia_submission_payment_page'),
                    get_theme_mod('realia_submission_remove_page'),
                    get_theme_mod('realia_submission_transactions_page'),
                    get_theme_mod('realsite_general_action'),
                )
            ));

        foreach($associated_posts as $post) {
            $exportOptions['post_associations'][$post->ID] = $post->post_name;
        }

        echo json_encode($exportOptions);
    }


    public function downloadHeaders() {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename=theme_options.json");
        header("Content-Transfer-Encoding: binary");
    }
}
