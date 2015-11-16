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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.


defined('MOODLE_INTERNAL') || die();
/**
 * Somo global fuctions
 *
 * @package    block_simple_certificate
 * @author	   Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */


/**
 * A facade to mod simplecertificade function.
 * 
 * @param stdClass $course
 * @param stdClass $cm
 * @param stdClass $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @return bool nothing if file not found, does not return anything if found - just send the file
 **/
function block_simple_certificate_pluginfile($course, $birecord_or_cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    global $CFG;
    
    require ($CFG->dirroot . '/mod/simplecertificate/lib.php');
    
    simplecertificate_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, $options);
} 



// /**
//  * Perform global search replace such as when migrating site to new URL.
//  * @param  $search
//  * @param  $replace
//  * @return void
//  */
// function block_html_global_db_replace($search, $replace) {
//     global $DB;

//     $instances = $DB->get_recordset('block_instances', array('blockname' => 'html'));
//     foreach ($instances as $instance) {
//         // TODO: intentionally hardcoded until MDL-26800 is fixed
//         $config = unserialize(base64_decode($instance->configdata));
//         if (isset($config->text) and is_string($config->text)) {
//             $config->text = str_replace($search, $replace, $config->text);
//             $DB->set_field('block_instances', 'configdata', base64_encode(serialize($config)), array('id' => $instance->id));
//         }
//     }
//     $instances->close();
// }
