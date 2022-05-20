<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc7c3ba1a61a627125df79c1e02e8b1de
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitc7c3ba1a61a627125df79c1e02e8b1de', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc7c3ba1a61a627125df79c1e02e8b1de', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc7c3ba1a61a627125df79c1e02e8b1de::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
