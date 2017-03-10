<?php
/**
 * Created by PhpStorm.
 * User: cmk
 * Date: 2017/3/10
 * Time: 20:20
 */

namespace horse003\event;


class Mourse {

    public function run($e){
        echo $e->message;
        echo 'mourse is runing<br />';
    }
}