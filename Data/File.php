<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 04.05.12
 * Time: 21:34
 * To change this template use File | Settings | File Templates.
 */
class PekaChat_Data_File implements PekaChat_Data_Interface
{
    protected $_config;
    protected $_path;

    public function __construct($config){
         $this->_config = $config;
         $this->_path = $this->_config['channel_path'];
    }

    public function createChannel($channel){
        $channel = str_replace(DIRECTORY_SEPARATOR, '', $channel);
        if(!is_file($this->_path.DIRECTORY_SEPARATOR.$channel)){
            touch($this->_path.DIRECTORY_SEPARATOR.$channel);    
        } else {
            throw new PekaChat_Exception("Channel '$channel' already exists ");
        }

    }

    public function deleteChannel($channel){
        $channel = str_replace(DIRECTORY_SEPARATOR, '', $channel);
        if(!is_file($this->_path.DIRECTORY_SEPARATOR.$channel)){
            throw new PekaChat_Exception("Channel '$channel' doesn't exist ");
        } else {
            unlink($this->_path.DIRECTORY_SEPARATOR.$channel);
        }
    }

    public function listChannels(){
        $channels = array();
        if ($handle = opendir($this->_path)) {

            while (false !== ($entry = readdir($handle))) {
                if(!is_dir($entry))
                    $channels[] = $entry;
            }

            closedir($handle);
        }

        return $channels;
    }

    public function getHistory($channel, $count){
        return null;
    }

    public function getHistoryByTime($channel, DateTime $from, DateTime $to){
        return null;
    }

    public function postToChannel($channel, $message){
        $channel = str_replace(DIRECTORY_SEPARATOR, '', $channel);
       // TODO: Remove-optimize with auth integration
        $iphash = md5($_SERVER['REMOTE_ADDR']);
        $col = substr($iphash,0,6);
        $message = '<p id="'.uniqid().'"><span  style="color:#'. $col .';">['.$col.']</span>: ' .$message."</p>\n";
        file_put_contents($this->_path.DIRECTORY_SEPARATOR.$channel, $message, FILE_APPEND);
    }

    public function getNewFromChannel($channel, DateTime $time){
        return null;
    }
}
