<?php

namespace AmMokhtari\AlertManager;

require_once __DIR__ . '/../vendor/autoload.php';

class Alert extends BaseClass
{
    private function __construct()
    {
    }

    /*---------------------------------------------------*/

    public static function all(): array
    {
        return parent::all();
    }

    public static function pullAll(): array
    {
        return parent::pullAll();
    }

    public static function pullAllFlashes(): array
    {
        return parent::pullAllFlashes();
    }

    public static function forgetAll(): bool
    {
        return parent::forgetAll();
    }

    /*---------------------------------------------------*/

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addNormalMessage(string $message, bool $isFlash = false): bool
    {
        return self::add('info', $message, $isFlash);
    }

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addDangerMessage(string $message, bool $isFlash = false): bool
    {
        return self::add('danger', $message, $isFlash);
    }

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addWarningMessage(string $message, bool $isFlash = false): bool
    {
        return self::add('warning', $message, $isFlash);
    }

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addSuccessMessage(string $message, bool $isFlash = false): bool
    {
        return self::add('success', $message, $isFlash);
    }

    /*---------------------------------------------------*/

    public static function getNormals(): array
    {
        return self::getByType('info');
    }

    public static function getDangers(): array
    {
        return self::getByType('danger');
    }

    public static function getWarnings(): array
    {
        return self::getByType('warning');
    }

    public static function getSuccesses(): array
    {
        return self::getByType('success');
    }

    /*---------------------------------------------------*/

    public static function pullNormals(): array
    {
        return self::pullByType('info');
    }

    public static function pullDangers(): array
    {
        return self::pullByType('danger');
    }

    public static function pullWarnings(): array
    {
        return self::pullByType('warning');
    }

    public static function pullSuccesses(): array
    {
        return self::pullByType('success');
    }

    /*---------------------------------------------------*/

    public static function pullNormalFlashes(): array
    {
        return self::pullFlashesByType('info');
    }

    public static function pullDangerFlashes(): array
    {
        return self::pullFlashesByType('danger');
    }

    public static function pullWarningFlashes(): array
    {
        return self::pullFlashesByType('warning');
    }

    public static function pullSuccessFlashes(): array
    {
        return self::pullFlashesByType('success');
    }

    /*---------------------------------------------------*/

    public static function forgetOneNormal(int $key): bool
    {
        return self::forgetOne('info', $key);
    }

    public static function forgetOneDanger(int $key): bool
    {
        return self::forgetOne('danger', $key);
    }

    public static function forgetOneWarning(int $key): bool
    {
        return self::forgetOne('warning', $key);
    }

    public static function forgetOneSuccess(int $key): bool
    {
        return self::forgetOne('success', $key);
    }

    /*---------------------------------------------------*/

    public static function forgetNormals(): bool
    {
        return self::forgetType('info');
    }

    public static function forgetDangers(): bool
    {
        return self::forgetType('danger');
    }

    public static function forgetWarnings(): bool
    {
        return self::forgetType('warning');
    }

    public static function forgetSuccesses(): bool
    {
        return self::forgetType('success');
    }
}