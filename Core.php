<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 04.05.12
 * Time: 19:33
 * To change this template use File | Settings | File Templates.
 */
class PekaChat_Core
{
    protected $_config;
    protected $_filters;
    protected $_dataEngine;

    public function __construct($config){
        $this->_config = $config;

        $filters = explode(',',$this->_config['filter']['enable']);

        foreach($filters as $filt){
            $filt = trim($filt);
            $classname = 'PekaChat_Filter_'.ucfirst($filt);
            if(class_exists($classname)){
                $this->_filters[] = new $classname($this->_config['filter-'.$filt]);
            } else
                throw new PekaChat_Exception("No class found for filter '$filt' ");
        }

        $configClassName = 'PekaChat_Data_'.ucfirst($this->_config['core']['data_engine']);
        if(class_exists($configClassName)){
            $this->_dataEngine = new $configClassName($this->_config['data-'.$this->_config['core']['data_engine']]);
        } else
            throw new PekaChat_Exception("No class found for data engine '$filt' ");

        $this->start();
    }

    public function start(){

        if(isset($_REQUEST['channel'])){
            $channel = str_replace(DIRECTORY_SEPARATOR,'',$_REQUEST['channel']);
        } else {
            $channel = $this->_config['core']['default_channel'];
        }

        if($_POST) {
            // TODO: move POST variable name to config
            $message = $_POST['msg'];
            $message = mb_substr($message,0,260);
            foreach($this->_filters as $f){
                //var_dump($f->filter($message));
                list($message, $stopFiltering) = $f->filter($message);
                if($stopFiltering)
                    break;
            }


            $this->_dataEngine->postToChannel($channel,$message);
            exit();

        }
        else {
            include('Template/default.phtml');
        }
    }

}
