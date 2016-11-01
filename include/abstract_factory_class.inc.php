<?php

/**
* 抽象作坊工厂
*/
abstract class abstract_factory_class
{

    /**
     * 工厂调用目录地址
     */
	abstract public function factory_path();

    /**
     * 工厂文件命名规则
     * @param string $name
     */
    abstract public function file_name_regular($name);

    /**
     * 工厂类命名规则
     * @param string $name
     */
    abstract public function class_regular($name);


    /**
     * 伪工厂- 访问指定 类:方法 (默认全部小写规则)
     * @param string $method [工厂名:工厂方法]
     * @return mixed
     */
    public function F($method)
    {
        list($factory_name, $factory_method) = explode(':', func_get_arg(0));

        $param_num = func_num_args()-1; // 去掉第一个非调用方法参数
        $file_path = $this->factory_path() .'/'. $this->file_name_regular(strtolower($factory_name));

        if (file_exists($file_path)) {
            require_once($file_path);
            $factory_name  = $this->class_regular($factory_name);
            $factory_obj   = new $factory_name();
            $class_methods = get_class_methods($factory_obj);

            if(in_array($factory_method, $class_methods)) {

                if($param_num >= 1) { /* 自定义传参 */
                    $params = array();
                    for ($i=1; $i<=$param_num; $i++) {
                        $params[] = func_get_arg($i);
                    }

                    return $result = call_user_func_array(array($factory_obj, $factory_method), $params);
                    // if($result) {
                    //     return $result;
                    // } else {
                    //     exit("ERROR: PLEASE CHECK PARAMS!");
                    // }
                }

                return $factory_obj->$factory_method();

            } else {
                exit("ERROR: {$file_path} NOT EXSITS METHOD {$factory_method}!");
            }
        } else {
            exit("ERROR: {$file_path} NOT EXSITS FILE {$factory_name}!");
        }
    }

}