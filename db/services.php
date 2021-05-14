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
 * ES6 Block.
 *
 * @package    block_es6
 * @copyright  &copy; 2021-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */

defined('MOODLE_INTERNAL') || die;

$functions = array(
    'block_es6_ajax_example' => array(
        'classname' => 'block_es6\output\external',
        'methodname' => 'es6_ajax_example',
        'description' => 'Generate a reply from the input example',
        'type' => 'read',
        'loginrequired' => true,
        'ajax' => true
    )
);

$services = array(
    'Block ES6 AJAX Example' => array(
        'functions' => array('block_es6_ajax_example'),
        'restrictedusers' => 0,
        'enabled' => 1
    )
);
