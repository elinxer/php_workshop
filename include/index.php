<?php

require __DIR__ . '/factory_class.inc.php';


$factory_obj = new factory_class();


$r = $factory_obj->F('test:test', '参数1','参数2');

var_dump($r);

