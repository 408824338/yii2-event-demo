<?php
/**
 * Created by PhpStorm.
 * User: cmk
 * Date: 2017/3/10
 * Time: 21:20
 * by 20170413 add test
 */

namespace horse003\event;

use yii\base\Component;

class Dog extends Component {

    public function look() {
        echo 'i am looking!<br />';
    }
}