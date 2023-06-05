<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit93b14a98431abb8c2db2a014cfeaaa75
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit93b14a98431abb8c2db2a014cfeaaa75::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit93b14a98431abb8c2db2a014cfeaaa75::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit93b14a98431abb8c2db2a014cfeaaa75::$classMap;

        }, null, ClassLoader::class);
    }
}
