<?php

class PMLauncherThemeOptionsImport implements  PMLauncherImporter {

    public function process($filepath) {
        $jsonString = file_get_contents($filepath);
        $jsonArray = json_decode($jsonString, true);

        $messages = theme_options_import($jsonArray);
        return  $messages;
    }

    public function report($messages) {
        include AVIATORS_LAUNCHER_PATH . '/template/messages.php';
    }
}

function theme_options_import($json_array) {
    $messages = array();
    $options = $json_array['options'];
    $menuAssociations = $json_array['menu_associations'];
    $postAssociations = $json_array['post_associations'];
    $realsiteOptions = $json_array['options']['theme_mods_realsite'];

    //Options
    foreach($options as $key => $option) {
        if(update_option($key, $option)) {
            $messages[] = $key;
        }
    }

    foreach($realsiteOptions as $key => $option) {
        set_theme_mod($key, $option);
        $messages[] = $key;
    }

    //Menus
    $menuLocations = get_theme_mod('nav_menu_locations');
    $newLocations = array();

    foreach($menuLocations as $location => $termId) {
        $term = get_term_by('slug', $menuAssociations[$termId], 'nav_menu');
        if(!is_wp_error($term)) {
            $newLocations[$location] = $term->term_id;
        }
        $messages[] = $term->slug;
    }
    set_theme_mod('nav_menu_locations', $newLocations);

    //Posts
    update_option('show_on_front', 'page');

    if(isset($postAssociations[get_option('page_on_front')])) {
        $post_name = $postAssociations[get_option('page_on_front')];

        $posts = get_posts(array('post_type' => 'page', 'name' => $post_name));
        if($posts) {
            $post = reset($posts);
            update_option('page_on_front', $post->ID);
        }
    }

    if(isset($postAssociations[get_option('page_for_posts')])) {
        $post_name = $postAssociations[get_option('page_for_posts')];

        $posts = get_posts(array('post_type' => 'page', 'name' => $post_name));
        if($posts) {
            $post = reset($posts);
            update_option('page_for_posts', $post->ID);
        }
    }

    if(isset($postAssociations[get_theme_mod('realsite_general_action')])) {
        $post_name = $postAssociations[get_theme_mod('realsite_general_action')];

        $posts = get_posts(array('post_type' => 'page', 'name' => $post_name));
        if($posts) {
            $post = reset($posts);
            set_theme_mod('realsite_general_action', $post->ID);
        }
    }

    if(isset($postAssociations[get_theme_mod('realia_submission_list_page')])) {
        $post_name = $postAssociations[get_theme_mod('realia_submission_list_page')];

        $posts = get_posts(array('post_type' => 'page', 'name' => $post_name));
        if($posts) {
            $post = reset($posts);
            set_theme_mod('realia_submission_list_page', $post->ID);
        }
    }

        $pagesThemeMods = array('realia_general_compare_page',
            'realia_general_favorites_page',
            'realia_general_login_required_page',
            'realia_general_password_page',
            'realia_general_profile_page',
            'realia_general_under_construction_page',
            'realia_submission_create_page',
            'realia_submission_edit_page',
            'realia_submission_list_page',
            'realia_submission_payment_page',
            'realia_submission_remove_page',
            'realia_submission_transactions_page',
            'realsite_general_action',
        );

//    $pagesThemeMods = array();
//
//    foreach ( $realsiteOptions as $realsiteOption ) {
//        if ( substr( key($realsiteOptions), -4) == "page" ) {
//            $pagesThemeMods[] = $realsiteOption;
//        }
//    }

    foreach ( $pagesThemeMods as $pagesThemeMod ) {
        if(isset($postAssociations[get_theme_mod($pagesThemeMod)])) {
            $post_name = $postAssociations[get_theme_mod($pagesThemeMod)];

            $posts = get_posts(array('post_type' => 'page', 'name' => $post_name));
            if($posts) {
                $post = reset($posts);
                set_theme_mod($pagesThemeMod, $post->ID);
            }
        }
    }

    return $messages;
}
