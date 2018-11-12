<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3178b0cbad98739b691563cd1385c3c8
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3178b0cbad98739b691563cd1385c3c8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3178b0cbad98739b691563cd1385c3c8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
