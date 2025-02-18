<?php

use ByJG\Config\DependencyInjection as DI;
use ByJG\Util\JwtKeySecret;

return [
    JwtKeySecret::class => DI::bind(JwtKeySecret::class)
        ->withConstructorArgs(['dMSEg/rWTMtmDX3S8UkD0njyWIjAi7US9DUaD97wSsC8SUBmTEc4/JUV9U6OleepHY3XJpmwqWWmYxQTGuCyWw=='])
        ->toSingleton(),
];
