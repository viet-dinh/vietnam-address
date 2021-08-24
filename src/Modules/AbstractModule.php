<?php


namespace Tool\Modules;


/**
 * Class AbstractModule
 * static will contain module instances
 * Module will contain repositories
 * @package Tool\Modules
 */
abstract class AbstractModule
{
    /** @var  static[] */
    private static array $instances = [];

    /**
     * @return static
     */
    public static final function getInstance()
    {
        if (!array_key_exists(static::class, self::$instances)) {
            self::$instances[static::class] = new static;
        }

        return self::$instances[static::class];
    }
}