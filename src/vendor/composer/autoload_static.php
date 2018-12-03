<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd9e182ba57208cf11b4c7719c000a882
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/../app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd9e182ba57208cf11b4c7719c000a882::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd9e182ba57208cf11b4c7719c000a882::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
