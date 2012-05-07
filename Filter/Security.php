<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 07.05.12
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */
class PekaChat_Filter_Security
{
    protected $_config;

    public function __construct($config) {
        $this->_config = $config;
    }

    public function filter($message, $originalMessage = null){

        $allow_html = $this->_config['allow_html'];
        if($allow_html){
            if($allow_html == 1 || $allow_html== 'true'){
                //$tags = null;
                $new_message = $message;
            } else {
                //$tags = $allow_html;
                $new_message = htmlspecialchars(strip_tags($message,$allow_html));
            }

        } else {
            $new_message = strip_tags($message);
        }

        if(!$this->_config['allow_multiline']){
            $new_message = htmlspecialchars(str_replace(PHP_EOL,'',$new_message));
        }

        return array($new_message, false);
    }
}
