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
 * block_es6 course users output class
 *
 * @package   block_es6
 * @copyright  2021 Richard Jones <richardnz@outlook.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace block_es6\local;

use renderable;
use renderer_base;
use templatable;
use stdClass;

/**
 * block es6: Create a new renderable object
 *
 * @copyright  2021 Richard Jones <richardnz@outlook.com>
 */

class course_users implements renderable, templatable {

    protected $header;
    protected $users;

    public function __construct($header, $users) {
        $this->header = $header;
        $this->users = $users;
    }
    // Prepare the data for output by the template.
    public function export_for_template(renderer_base $output) {

        $data = new stdClass();
        $data->header = $this->header;
        $data->studentlist = array();

        if ($this->users) {
            foreach ($this->users as $user) {
                $data->studentlist[] = $user->lastname . ', ' . $user->firstname;
            }
        }
        return $data;
    }
}