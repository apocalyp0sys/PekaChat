<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 04.05.12
 * Time: 21:29
 * To change this template use File | Settings | File Templates.
 */
interface PekaChat_Filter_Interface
{
    public function filter($message, $originalMessage = null);
}
