<?php
/**
 * Created by PhpStorm.
 * User: r14003530
 * Date: 15/12/15
 * Time: 14:46
 */

abstract class Feed {
    public function __get($attr) {
        return $this->reader->channel->$attr;
    }

    public abstract function getItems();

    public abstract function updateDatabase();
}
