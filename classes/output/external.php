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

namespace block_es6\output;

defined('MOODLE_INTERNAL') || die();

/**
 * ES6 Block.
 *
 * @package    block_es6
 * @copyright  &copy; 2021-onwards G J Barnard.
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later.
 */
class external extends \core\output\external {

    /**
     * Return generated markup.
     *
     * @param string $text Text.
     *
     * @return string the markup.
     */
    public static function es6_ajax_example($text) {
        // Parameter validation.
        self::validate_parameters(
            self::es6_ajax_example_parameters(),
            array(
                'text' => $text
            )
        );

        global $OUTPUT, $PAGE, $USER;
        $templatecontext = array(
            'thetext' => $text,
            'firstname' => $USER->firstname,
            'lastname' => $USER->lastname
        );
        $PAGE->set_context(\context_system::instance());
        $markup = $OUTPUT->render_from_template('block_es6/ajaxresponse', $templatecontext);

        return array('markup' => $markup);
    }

    /**
     * Returns description of method parameters.
     *
     * @return external_function_parameters.
     */
    public static function es6_ajax_example_parameters() {
        return new \external_function_parameters(
            array(
                'text' => new \external_value(PARAM_TEXT, 'Text', VALUE_REQUIRED, null, NULL_NOT_ALLOWED)
            )
        );
    }

    /**
     * Returns description of method result value.
     *
     * @return external_description.
     */
    public static function es6_ajax_example_returns() {
        return new \external_single_structure(
            array(
                'markup' => new \external_value(PARAM_RAW, 'Markup'),
            ),
            'Mustache template'
        );
    }
}
