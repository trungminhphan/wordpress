<?php
/**
 * @package  EscaladePlugin
 */
/*
Plugin Name: Escalade Plugin
Plugin URI: /plugin
Description: This plugin for booking resort online
Version: 1.0.0
Author: Phan Minh Trung
Author URI: http://escalade.com.vn
License: GPLv2 or later
Text Domain: escalade-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

defined( 'ABSPATH' ) or die( 'Hey, you can\t access this file, you silly human!' );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_escalade_plugin() {
    Models\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_escalade_plugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivate_escalade_plugin() {
    Models\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_escalade_plugin' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Controllers\\InitController' ) ) {
    Controllers\InitController::registerServices();
}
