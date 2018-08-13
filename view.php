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
 * Simple Certificate block outline view.
 *
 * @package block_simple_certificate
 * @author Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

require_once('../../config.php');
require_once('../moodleblock.class.php');
require_once('block_simple_certificate.php');

global $DB, $COURSE, $OUTPUT, $PAGE, $USER;

// Check for all required variables.
$cid = optional_param('cid', $COURSE->id, PARAM_INT);
$course = $DB->get_record('course', array('id' => $cid));
if (!$course) {
    print_error('invalidcourse', 'block_simple_certificate', $cid);
}

require_login($course);

$url = new moodle_url('/blocks/simple_certificate/view.php');
if ($cid !== $COURSE->id) {
    $url->param('cid', $cid);
}

$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');

// Bread Crums.
$settingsnode = $PAGE->settingsnav->add(get_string('configtitle', 'block_simple_certificate'));
$editnode = $settingsnode->add(get_string('mycertificates', 'block_simple_certificate'), $url);
$editnode->make_active();
echo $OUTPUT->header();

// To get all certificates must put courseid null and all=true.
$certificates = block_simple_certificate::get_issued_certificates($USER->id, null);
$renderer = $PAGE->get_renderer('block_simple_certificate');
$content = $renderer->block_simple_certificate_tree($certificates, true, true);

echo $OUTPUT->box($content);
echo $OUTPUT->footer();
