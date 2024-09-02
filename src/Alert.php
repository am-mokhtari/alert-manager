<?php

namespace AmMokhtari\AlertManager;

require_once __DIR__ . '/../vendor/autoload.php';

class Alert extends AlertManager
{
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
}