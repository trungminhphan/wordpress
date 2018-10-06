<?php
/**
 * @package  EscaladePlugin
 */
namespace Models;

class Deactivate
{
    public static function deactivate() {
        flush_rewrite_rules();
    }
}
