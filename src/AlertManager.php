<?php

namespace AmMokhtari\AlertManager;

require_once __DIR__ . '/../vendor/autoload.php';
session_start();

abstract class AlertManager
{
    /**
     * Store Alerts
     * @param string $type
     * @param string $message
     * @param bool $isFlash
     * @return bool
     */
    protected static function add(string $type, string $message, bool $isFlash): bool
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
    protected static function checkMessageExist(string $type, string $message, ?bool $flashes): bool
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
     * To Get All Alerts Without Removing
     * @return array
     */
    public static function all(): array
    {
        $all = [];
        if (isset($_SESSION["alerts"]))
            $all = $_SESSION["alerts"];
        return $all;
    }

    /**
     * To Get All Alerts With $type Type Without Removing
     * @param string $type
     * @return array
     */
    protected static function getByType(string $type): array
    {
        $allInType = [];
        if (isset($_SESSION["alerts"][$type]))
            $allInType = $_SESSION["alerts"][$type];

        return $allInType;
    }

    /**
     * To Get All Alerts With Type $type And Remove them After
     * @param string $type
     * @return array
     */
    protected static function pullByType(string $type): array
    {
        $allInType = self::getByType($type);
        self::forgetType($type);

        return $allInType;
    }

    /**
     * To Get All Flash Messages With Type $type And Remove them After
     * @param string $type
     * @return array
     */
    protected static function pullFlashesByType(string $type): array
    {
        $allInType = [];
        if (isset($_SESSION["flashes"][$type])) {
            $allInType = $_SESSION["flashes"][$type];
            unset($_SESSION["flashes"][$type]);
        }

        return $allInType;
    }

    /**
     * To Get All Alerts And Remove All After
     * @return array
     */
    public static function pullAll(): array
    {
        $all = self::all();
        self::forgetAll();

        return $all;
    }

    /**
     * To Get All Flash Messages And Remove All After
     * @return array
     */
    public static function pullAllFlashes(): array
    {
        $all = [];
        if (isset($_SESSION["flashes"])) {
            $all = $_SESSION["flashes"];
            unset($_SESSION["flashes"]);
        }

        return $all;
    }

    /**
     * To Remove Alerts with $type Type
     * @param string $type
     * @param int $key
     * @return bool
     */
    protected static function forgetOne(string $type, int $key): bool
    {
        unset($_SESSION["alerts"][$type][$key]);
        return true;
    }

    /**
     * To Remove Alerts with $type Type
     * @param string $type
     * @return bool
     */
    protected static function forgetType(string $type): bool
    {
        unset($_SESSION["alerts"][$type]);
        return true;
    }

    /**
     * To Remove All Alerts
     * @return bool
     */
    public static function forgetAll(): bool
    {
        unset($_SESSION["alerts"]);
        return true;
    }

}