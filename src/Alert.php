<?php

namespace AmMokhtari\AlertManager;

require_once '../vendor/autoload.php';

session_start();

class Alert implements AlertManagerInterface
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

    /**
     * Store Alerts
     * @param string $type
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    private static function add(string $type, string $message, bool $isFlash): bool
    {
        /* check the message exist */
        if (!self::checkMessageExist($type, $message, $isFlash)) {
            return false;
        }

        /* set session */
        if ($isFlash)
            $_SESSION["flashes"][$type][] = $message;
        else
            $_SESSION["alerts"][$type][] = $message;

        return true;
    }

    /**
     * To Avoid Adding a Duplicate Message
     * @param string $type
     * @param string $message
     * @param bool $flashes
     * @return bool
     */
    private static function checkMessageExist(string $type, string $message, ?bool $flashes): bool
    {
        if (
            $flashes && isset($_SESSION["flashes"][$type]) && in_array($message, $_SESSION["flashes"][$type])
        ) {
            return false;

        } elseif (
            isset($_SESSION["alerts"][$type]) && in_array($message, $_SESSION["alerts"][$type])
        ) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public static function all(): array
    {
        $all = [];
        if (isset($_SESSION["alerts"]))
            $all = $_SESSION["alerts"];
        return $all;
    }

    /**
     * @inheritDoc
     */
    public static function getByType(string $type): array
    {
        $allInType = [];
        if (isset($_SESSION["alerts"][$type]))
            $allInType = $_SESSION["alerts"][$type];

        return $allInType;
    }

    /**
     * @inheritDoc
     */
    public static function pullByType(string $type): array
    {
        $allInType = self::getByType($type);
        self::forgetType($type);

        return $allInType;
    }

    /**
     * @inheritDoc
     */
    public static function pullFlashesByType(string $type): array
    {
        $allInType = [];
        if (isset($_SESSION["flashes"][$type])) {
            $allInType = $_SESSION["flashes"][$type];
            unset($_SESSION["flashes"][$type]);
        }

        return $allInType;
    }

    /**
     * @inheritDoc
     */
    public static function pullAll(): array
    {
        $all = self::all();
        self::forgetAll();

        return $all;
    }

    /**
     * @inheritDoc
     */
    static function pullAllFlashes(): array
    {
        $all = [];
        if (isset($_SESSION["flashes"])) {
            $all = $_SESSION["flashes"];
            unset($_SESSION["flashes"]);
        }

        return $all;
    }

    /**
     * @inheritDoc
     */
    static function forgetOne(string $type, int $key): bool
    {
        unset($_SESSION["alerts"][$type][$key]);
        return true;
    }

    /**
     * @inheritDoc
     */
    static function forgetType(string $type): bool
    {
        unset($_SESSION["alerts"][$type]);
        return true;
    }

    /**
     * @inheritDoc
     */
    static function forgetAll(): bool
    {
        unset($_SESSION["alerts"]);
        return true;
    }

}

//---Test------------------------------------
//Alert::addDangerMessage('dangered');
//Alert::addSuccessMessage('success');
//
//var_dump(Alert::getByType('danger'));
//echo '<br>';
//var_dump(Alert::all());
//echo '<br>';
//var_dump(Alert::pullByType('success'));
//echo '<br>';
//var_dump(Alert::pullAll());
//echo '<br>';
//var_dump(Alert::all());