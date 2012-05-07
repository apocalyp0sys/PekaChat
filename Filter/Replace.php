<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 04.05.12
 * Time: 21:31
 * To change this template use File | Settings | File Templates.
 */
class PekaChat_Filter_Replace implements PekaChat_Filter_Interface
{
    protected $_needle;
    protected $_replacement;

    public function __construct($needle, $replacement){
        $this->_needle = $needle;
        $this->_replacement = $replacement;
    }

    public function filter($message, $originalMessage = null){
        return array(str_replace($this->_needle,$this->_replacement,$message),false);
    }
}
