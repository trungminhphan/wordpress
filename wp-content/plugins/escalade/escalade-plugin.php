<?php
/**
 * @package  EscaladePlugin
 */
/*
Plugin Name: Escalade Plugin
Plugin URI: http://wp.com/plugin
Description: This plugin for booking resort online
Version: 1.0.0
Author: Phan Minh Trung
Author URI: http://wp.com
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

class EscaladePlugin
{
    function __construct() {
        add_action( 'init', array( $this, 'custom_post_type' ) );
    }

    function activate() {
        // generated a CPT
        // flush rewrite rules
    }

    function deactivate() {
        // flush rewrite rules
    }

    function uninstall() {
        // delete CPT
        // delete all the plugin data from the DB
    }

    function custom_post_type() {
        register_post_type( 'accommodation_category', array( 'public' => true, 'label' => 'Accommodation Category' ) );
    }
}

if ( class_exists( 'EscaladePlugin' ) ) {
    $escaladePlugin = new EscaladePlugin();
}

// activation
register_activation_hook( __FILE__, array( $escaladePlugin, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $escaladePlugin, 'deactivate' ) );

// uninstall
