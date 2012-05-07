<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 04.05.12
 * Time: 19:33
 * To change this template use File | Settings | File Templates.
 */
class PekaChat
{
    protected $_core;
    //protected $_config;

    private function registerAutoload(){
         return spl_autoload_register(array($this, 'autoload'), false);
    }

    private function autoload($className){
        $path = str_replace(
            array('PekaChat_','_'),
            array('',DIRECTORY_SEPARATOR),
            $className
        );
        require_once($path.'.php');
    }

    public function __construct($config = 'config.ini'){
        $this->registerAutoload();

        if(!is_array($config)){
            if(!$config = parse_ini_file($config, true))
                throw new PekaChat_Exception('No config provided');
        }

        $this->_core = new PekaChat_Core($config);

    }

}
