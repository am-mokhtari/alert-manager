<?php

namespace AmMokhtari\AlertManager;

require_once '../vendor/autoload.php';

session_start();

class Alert implements AlertManagerInterface
{
    /**
     * @param string $message
     * @return bool
     */
    public static function addNormalMessage(string $message): bool
    {
        return self::add('info', $message);
    }

    /**
     * @param string $message
     * @return bool
     */
    public static function addDangerMessage(string $message): bool
    {
        return self::add('danger', $message);
    }

    /**
     * @param string $message
     * @return bool
     */
    public static function addWarningMessage(string $message): bool
    {
        return self::add('warning', $message);
    }

    /**
     * @param string $message
     * @return bool
     */
    public static function addSuccessMessage(string $message): bool
    {
        return self::add('success', $message);
    }

    /**
     * @param string $type
     * @param string $message
     * @return bool
     */
    private static function add(string $type, string $message): bool
    {
        /* check the message exist */
        if (!self::checkMessageExist($type, $message)) {
            return false;
        }

        /* set session */
        $_SESSION["alert-$type"][] = $message;
        return true;
    }

    /**
     * @param string $type
     * @param string $message
     * @return bool
     */
    private static function checkMessageExist(string $type, string $message): bool
    {
        if (isset($_SESSION["alert-$type"]) && in_array($message, $_SESSION["alert-$type"])) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        $all = [];
        if (isset($_SESSION["alert-info"])) $all = array_merge($all, $_SESSION["alert-info"]);
        if (isset($_SESSION["alert-danger"])) $all = array_merge($all, $_SESSION["alert-danger"]);
        if (isset($_SESSION["alert-warning"])) $all = array_merge($all, $_SESSION["alert-warning"]);
        if (isset($_SESSION["alert-success"])) $all = array_merge($all, $_SESSION["alert-success"]);
        return $all;
    }

    /**
     * @param string $type
     * @return array
     */
    public static function getByType(string $type): array
    {
        $allInType = [];
        if (isset($_SESSION["alert-$type"]))
            $allInType = array_merge($allInType, $_SESSION["alert-$type"]);

        return $allInType;
    }

    /**
     * @param string $type
     * @return array
     */
    public static function pullByType(string $type): array
    {
        $allInType = self::getByType($type);
        unset($_SESSION["alert-$type"]);

        return $allInType;
    }

    /**
     * @return array
     */
    public static function pullAll(): array
    {
        $all = self::all();
        unset($_SESSION["alert-info"], $_SESSION["alert-danger"], $_SESSION["alert-warning"], $_SESSION["alert-success"]);

        return $all;
    }

    /**
     * @param string $type
     * @param int $key
     * @return bool
     */
    static function forgetOne(string $type, int $key): bool
    {
        unset($_SESSION["alert-$type"][$key]);
        return true;
    }

    /**
     * @param string $type
     * @return bool
     */
    static function forgetType(string $type): bool
    {
        unset($_SESSION["alert-$type"]);
        return true;
    }

    /**
     * @return bool
     */
    static function forgetAll(): bool
    {
        unset($_SESSION["alert-info"], $_SESSION["alert-danger"], $_SESSION["alert-warning"], $_SESSION["alert-success"]);
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