<?php

namespace Mirovit\IonicPlatformSDK\Validators;

/**
 * @method bool hasKeys(array $shouldHave, array $has)
 */
class Validator
{
    public function __call($name, $arguments)
    {
        $name = __NAMESPACE__ . '\\' . ucwords($name);

        if(!class_exists($name)) {
            return false;
        }

        $reflection = new \ReflectionClass($name);
        return $reflection->newInstanceArgs($arguments)->validate();
    }
}