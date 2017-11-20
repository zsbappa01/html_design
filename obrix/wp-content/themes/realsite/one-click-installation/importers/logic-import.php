<?php


class PMLauncherWidgetLogicImport implements PMLauncherImporter {

    public function process($filepath) {
        $jsonString = file_get_contents($filepath);
        $options = json_decode($jsonString, true);

        $messages = array();

        if(update_option('widget_logic', $options)) {
            $messages[] = 'Widget logic was updated with success';
        }
        
        return $messages;
    }

    public function report($messages) {
        include AVIATORS_LAUNCHER_PATH . '/template/messages.php';
    }
}