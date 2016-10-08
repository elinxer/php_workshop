<?php

require __DIR__ . '/abstract_factory_class.inc.php';

/**
* 抽象作坊工厂继承使用 例子
*/
class factory_class extends abstract_factory_class
{

	public function factory_path() {
		return __DIR__;
	}

    public function file_name_regular($name) {
        return "vf_{$name}_factory_class.inc.php";
    }

    public function class_regular($name) {
        return "vf_{$name}_factory_class";
    }



}