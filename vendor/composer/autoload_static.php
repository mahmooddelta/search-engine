<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0c196703d4f3a54ae05025934ec58237
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Provider\\' => 13,
            'App\\Interfaces\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Provider\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Provider',
        ),
        'App\\Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Interfaces',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0c196703d4f3a54ae05025934ec58237::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0c196703d4f3a54ae05025934ec58237::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0c196703d4f3a54ae05025934ec58237::$classMap;

        }, null, ClassLoader::class);
    }
}
