<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 08.05.12
 * Time: 0:09
 * To change this template use File | Settings | File Templates.
 */
class PekaChat_Filter_Smiles
{

    protected $_map = array(
        'peka' => 'img/smiles/peka.png',
        'sex' => 'img/smiles/sex.png',
        'happy' => 'img/smiles/happy.png',
        'fp' => 'img/smiles/fp.png'
    );
    //protected $_config;

    public function __construct() {

    }

    public function filter($message, $originalMessage = null){
        $new_message = $message;
        foreach($this->_map as $code => $img){
            $new_message = str_replace(":$code:",'<img src="'.$img.'" />',$new_message);
        }
        return array($new_message, false);
    }
}
