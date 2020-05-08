<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc26d8cd1ea90f6c1ae1d4f15fae17b9a
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Ulid\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ulid\\' => 
        array (
            0 => __DIR__ . '/..' . '/robinvdvleuten/ulid/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc26d8cd1ea90f6c1ae1d4f15fae17b9a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc26d8cd1ea90f6c1ae1d4f15fae17b9a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}