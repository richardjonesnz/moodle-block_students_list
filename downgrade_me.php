<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Block ES6.
 *
 * @package    block_es6
 * @copyright  &copy; 2021-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

require_once(__DIR__.'/../../config.php');
require_login();

if (is_siteadmin()) {
    $plugin = new stdClass;
    require_once('version.php');
    set_config('allversionshash', '');
    $currentconfigversion = get_config('block_es6', 'version');
    $currentversionversion = $plugin->version;
    $newversion = $plugin->version - 1;
    set_config('version', $newversion, 'block_es6');
    echo 'Block ES6 downgraded to version: '.$newversion.' from config version '.$currentconfigversion.', version.php version '.$currentversionversion.'.';
}
