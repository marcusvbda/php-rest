<?php

use ByJG\Config\DependencyInjection as DI;
use ByJG\Util\JwtKeySecret;

return [
    JwtKeySecret::class => DI::bind(JwtKeySecret::class)
        ->withConstructorArgs(['FbJnvR5OlQlRjoTjyAtugIvERb+f6AIOV6nmd01+fXHjSzLayt7OUn0NuYN3F5cjxDDTb1MM56CquPjxN9Cc5A=='])
        ->toSingleton(),
];

