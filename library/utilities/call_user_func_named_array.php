<?php

function call_user_func_named_array($class, $method, $arguments)
{
    $reflectionMethod = new ReflectionMethod($class, $method);
    $parameters = [];

    foreach ($reflectionMethod->getParameters() as $parameter) {
        $defaultValue = $parameter->isOptional()
            ? $parameter->getDefaultValue()
            : null; 
        $parameters[] = $arguments[$parameter->name] ?? $defaultValue;
    }

    return $reflectionMethod->invokeArgs($class, $parameters);
}
