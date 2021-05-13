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
    protected $courseid;

    public function __construct($header, $courseid) {
        $this->header = $header;
        $this->courseid = $courseid;
    }
    // Prepare the data for output by the template.
    public function export_for_template(renderer_base $output) {
        global $USER;

        $data = new stdClass();
        $data->header = $this->header;
        $data->headerclass = 'block_es6_header';
        $data->name = fullname($USER);

        // Prepare a list of student users.
        $data->studentlist = array();
        $students = self::get_course_students($this->courseid);

        foreach ($students as $student) {
                $data->studentlist[] = $student->lastname . ', ' . $student->firstname;
        }

        return $data;
    }

    private static function get_course_students($courseid) {
        global $DB;

        $sql = "SELECT u.id, u.firstname, u.lastname, u.email
                FROM {course} as c
                JOIN {context} as x ON c.id = x.instanceid
                JOIN {role_assignments} as r ON r.contextid = x.id
                JOIN {user} AS u ON u.id = r.userid
               WHERE c.id = :courseid
                 AND r.roleid = :roleid";

        // In real world query should check users are not deleted/suspended.
        $records = $DB->get_records_sql($sql, ['courseid' => $courseid, 'roleid' => 5]);

        return $records;
    }
}