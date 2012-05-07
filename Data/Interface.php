<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ap
 * Date: 04.05.12
 * Time: 21:32
 * To change this template use File | Settings | File Templates.
 */
interface PekaChat_Data_Interface
{
    public function createChannel($channel);

    public function deleteChannel($channel);

    public function listChannels();

    public function getHistory($channel, $count);

    public function getHistoryByTime($channel, DateTime $from, DateTime $to);

    public function postToChannel($channel, $message);

    public function getNewFromChannel($channel, DateTime $time);
}
