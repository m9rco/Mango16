<?php
namespace library\Base;
/**
 * inversion of control
 */
class OrderRegistry
{
    private $utensil = array();
    /**
     * [__set description]
     * @Author   蒲绍巍<pushaowei@sporte.cn>
     * @DateTime 2016-10-22T15:59:49+0800
     * @param    [type]                   $key [description]
     * @param    [type]                   $value [description]
     */
    public function __set($key, $value)
    {
        $this->utensil[$key] = $value;
    }
    /**
     * [__get description]
     * @Author   蒲绍巍<pushaowei@sporte.cn>
     * @DateTime 2016-10-22T15:59:53+0800
     * @param    [type]                   $k [description]
     * @return   [type]                      [description]
     */
    public function __get($key)
    {
        return $this->build($this->utensil[$key]);
    }

    /**
     * [build 自动绑定 && 自动解析]
     * @Author   蒲绍巍<pushaowei@sporte.cn>
     * @DateTime 2016-10-22T15:58:17+0800
     * @param    [type]                   $className [description]
     * @return   [type]                              [description]
     */
    public function build($className)
    {
        // 如果是匿名函数（Anonymous functions），也叫闭包函数（closures）
        $className = $this->stringSwitch($className);
        if ($className instanceof \Closure) {
        // 执行闭包函数，并将结果
            return $className($this);
        }
        /** @var ReflectionClass $reflector */
        $reflector = new \ReflectionClass($className);
        // 检查类是否可实例化, 排除抽象类abstract和对象接口interface
        if (!$reflector->isInstantiable()) {
            throw new Exception("Can't instantiate this.");
        }

        /** @var ReflectionMethod $constructor 获取类的构造函数 */
        $constructor = $reflector->getConstructor();
        // 若无构造函数，直接实例化并返回
        if (is_null($constructor)) {
            return new $className;
        }

        // 取构造函数参数,通过 ReflectionParameter 数组返回参数列表
        $parameters = $constructor->getParameters();

        // 递归解析构造函数的参数
        $dependencies = $this->getDependencies($parameters);

        // 创建一个类的新实例，给出的参数将传递到类的构造函数。
        return $reflector->newInstanceArgs($dependencies);
    }

    /**
     * @param array $parameters
     * @return array
     * @throws Exception
     */
    public function getDependencies($parameters)
    {
        $dependencies = [];

        /** @var ReflectionParameter $parameter */
        foreach ($parameters as $parameter) {
            /** @var ReflectionClass $dependency */
            $dependency = $parameter->getClass();

            if (is_null($dependency)) {
                // 是变量,有默认值则设置默认值
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                // 是一个类，递归解析
                $dependencies[] = $this->build($dependency->name);
            }
        }
        return $dependencies;
    }

    /**
     * @param ReflectionParameter $parameter
     * @return mixed
     * @throws Exception
     */
    public function resolveNonClass($parameter)
    {
        // 有默认值则返回默认值
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }

        throw new Exception('I have no idea what to do here.');
    }
    /**
     * [stringSwitch stringSwitch]
     * @Author   蒲绍巍<pushaowei@sporte.cn>
     * @DateTime 2016-10-22T17:15:24+0800
     * @param    [type]                   $string [description]
     * @return   [type]                           [description]
     */
    public function stringSwitch($string)
    {
       $container = [
            'Order'     => new Order,
        ];

         return $container[$string];
    }
}
