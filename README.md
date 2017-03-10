yii2-event-demo
===============
yii2-event-demo

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist horse003/yii2-event-demo "*"
```

or add

```
"horse003/yii2-event-demo": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \horse003\event\AutoloadExample::widget(); ?>
```

#事件举例
##1.猫来了，老鼠就跑了   trigger()  on()  
```php
    public function actionAnimal(){
        $cat = new Cat();
        $mouse = new Mourse();
        $cat->on('miao',[$mouse,'run']);
        $cat->shout();

    }
 //输出
 miao maio miao  
 mourse is runing  
```
##2.加入事件传参数 
```php
#vendor/horse003/yii2-event-demo/src/Cat.php  
    public function shout() {
        echo 'miao maio miao<br />';

        //1.加入一个事件，传话筒
        $me = new MyEvent();
        $me->message = 'hello my is event<br />';
        //2.发送事件
        $this->trigger('miao', $me);
    }
#vendor/horse003/yii2-event-demo/src/Mourse.php
 class Mourse {
    
     //3.$e 接收事件
     public function run($e){
         echo $e->message;
         echo 'mourse is runing<br />';
     }
 }
     //输出
miao maio miao  
hello my is event  
mourse is runing  
```
##3.加入dog角色  
>猫叫，老鼠跑了，小跑在看
```php
    public function actionAnimal(){
        $cat = new Cat();
        $mouse = new Mourse();
        $dog = new Dog();
        $cat->on('miao',[$mouse,'run']);
        $cat->on('miao',[$dog,'look']);
        $cat->shout();

    }
//输出
    miao maio miao
    hello my is event
    mourse is runing
    i am looking!
    
```

##4.取消狗在看的动作
```php
    public function actionAnimal(){
        $cat = new Cat();
        $mouse = new Mourse();
        $dog = new Dog();
        $cat->on('miao',[$mouse,'run']);
        $cat->on('miao',[$dog,'look']);
        $cat->off('miao',[$dog,'look']);
        $cat->shout();

    }
//输出
    miao maio miao
    hello my is event
    mourse is runing
```

##5.实例化多一只猫对象，却只有上面的一只老鼠在跑(一个事件在跑)
```php
    public function actionAnimal(){
        $cat = new Cat();
        $cat2 = new Cat();
        $mouse = new Mourse();
        $dog = new Dog();
        $cat->on('miao',[$mouse,'run']);

        $cat->shout();
        $cat2->shout();

    }
//输出    
 miao maio miao
 hello my is event
 mourse is runing
 miao maio miao   
```

##5.1 对5的改进，实例化多个猫对象，能否对应的老鼠都在跑呢？
```php
    public function actionAnimal(){
        $cat = new Cat();
        $cat2 = new Cat();
        $mouse = new Mourse();
        $dog = new Dog();
       // $cat->on('miao',[$mouse,'run']);
        Event::on(cat::className(),'miao',[$mouse,'run']);
        $cat->shout();
        $cat2->shout();

    }
//输出   
miao maio miao
hello my is event
mourse is runing
miao maio miao
hello my is event
mourse is runing
```

##5.2 加入匿名函数，运行后触发
```php
    public function actionAnimal() {
        $cat = new Cat();
        $cat2 = new Cat();
        $mouse = new Mourse();
        $dog = new Dog();

        Event::on(Cat::className(), 'miao', function(){
            echo 'miao event has triggered<br/>';
        });
        $cat->shout();
        $cat2->shout();

    }
 //输出   
 miao maio miao
 miao event has triggered
 miao maio miao
 miao event has triggered   
    
```    