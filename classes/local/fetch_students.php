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
 * block_students output.
 *
 * @package   block_students
 * @copyright  2021 Richard Jones <richardnz@outlook.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_students\local;
use renderable;
use renderer_base;
use templatable;
use stdClass;

/**
 * Class to get a list of student details per course.
 *
 * @var header - string heading for the list
 * @var courseid - int the id of the course the block is in.
 */

class fetch_students implements renderable, templatable {

    protected $header;
    protected $courseid;

    /**
     * Constructor.
     *
     * @param header - string heading for the list
     * @param courseid - int the id of the course the block is in.
     */
    public function __construct($header, $courseid) {
        $this->header = $header;
        $this->courseid = $courseid;
    }

    // Prepare the data for output by the template.
    public function export_for_template(renderer_base $output) {
        global $USER;

        $data = new stdClass();
        $data->header = $this->header;
        $data->headerclass = 'block_students_header';
        $data->studentlist = array();

        // Prepare a list of student users.
        $students = self::get_course_students($this->courseid);

        // Select the data to be shown in the template.
        foreach ($students as $student) {
            $list = array();
            $list['name'] = $student->lastname . ', ' . $student->firstname;
            $list['email'] = $student->email;
            $list['ip'] = ($student->lastip == null) ? 'no ip data' : $student->lastip;
            $list['access'] = ($student->lastaccess == 0) ? 'unknown' :
                    date("F j, Y, g:i a", $student->lastaccess);
            $list['pic'] = $student->pic;
            $data->studentlist[] = $list;
        }

        // Return data for use by template.
        return $data;
    }
    /**
     * Query the DB for a list of course users (students only)
     *
     * @param courseid - int the id of the course the block is in.
     */
    private static function get_course_students($courseid) {
        global $DB, $OUTPUT;

        $sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess, u.lastip, u.suspended
                FROM {course} c
                JOIN {context} x ON c.id = x.instanceid
                JOIN {role_assignments} r ON r.contextid = x.id
                JOIN {user} u ON u.id = r.userid
               WHERE c.id = :courseid
                 AND r.roleid = :roleid
                 AND u.suspended = :status";

        $students = $DB->get_records_sql($sql, ['courseid' => $courseid,  // Current course.
                                                'roleid' => 5,            // Student role.
                                                'status' => 0]);          // Not suspended.

        // Grab the url of the user profile picture.
        foreach ($students as $student) {
            $rs = $DB->get_record_select("user", "id = '$student->id'", null,
                    \user_picture::fields());
            $student->pic = $OUTPUT->user_picture($rs);
        }

        return (array) $students;
    }
}