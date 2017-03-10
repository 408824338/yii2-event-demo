<?php
/**
 * Created by PhpStorm.
 * User: cmk
 * Date: 2017/3/10
 * Time: 20:18
 */

namespace horse003\event;

use yii\base\Component;

class Cat extends Component {
    public function shout() {
        echo 'miao maio miao<br />';

        //加入一个事件，传话筒
        $me = new MyEvent();
        $me->message = 'hello my is event<br />';

        $this->trigger('miao', $me);
    }

}