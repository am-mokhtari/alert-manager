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
        return static::add('info', $message, $isFlash);
    }

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addDangerMessage(string $message, bool $isFlash = false): bool
    {
        return static::add('danger', $message, $isFlash);
    }

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addWarningMessage(string $message, bool $isFlash = false): bool
    {
        return static::add('warning', $message, $isFlash);
    }

    /**
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    public static function addSuccessMessage(string $message, bool $isFlash = false): bool
    {
        return static::add('success', $message, $isFlash);
    }

}