<?php

namespace AmMokhtari\AlertManager;

interface AlertManagerInterface
{
    /**
     * To Get All Alerts Without Removing
     * @return array
     */
    static function all(): array;

    /**
     * To Get All Alerts With $type Type Without Removing
     * @param string $type
     * @return array
     */
    static function getByType(string $type): array;

    /**
     * To Get All Alerts With Type $type And Remove them After
     * @param string $type
     * @return array
     */
    static function pullByType(string $type): array;

    /**
     * To Get All Alerts And Remove All After
     * @return array
     */
    static function pullAll(): array;

    /**
     * To Remove Alerts with $type Type
     * @param string $type
     * @param int $key
     * @return bool
     */
    static function forgetOne(string $type, int $key): bool;

    /**
     * To Remove Alerts with $type Type
     * @param string $type
     * @return bool
     */
    static function forgetType(string $type): bool;

    /**
     * To Remove All Alerts
     * @return bool
     */
    static function forgetAll(): bool;
}