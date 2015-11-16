<?php
/**
 * Simple Certificate block outline view.
 * 
 * @package block_simple_certificate
 * @author Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

require_once ('../../config.php');
require_once ('../moodleblock.class.php');
require_once ('block_simple_certificate.php');
// require('render.php');

// global $DB;
global $DB, $COURSE, $OUTPUT, $PAGE;

// Check for all required variables.
$uid = required_param('uid', PARAM_INT);
$cid = optional_param('cid', $COURSE->id, PARAM_INT);

if (!$course = $DB->get_record('course', array('id' => $cid))) {
    print_error('invalidcourse', 'block_simple_certificate', $cid);
}

require_login($course);

$url = new moodle_url('/blocks/simple_certificate/view.php', array('uid' => $uid));
if ($cid !== $COURSE->id) {
    $url->param('cid', $cid);
}

$PAGE->set_url($url);
$PAGE->set_pagelayout('standard');

// Bread Crums
$settingsnode = $PAGE->settingsnav->add(get_string('configtitle', 'block_simple_certificate'));
$editnode = $settingsnode->add(get_string('mycertificates', 'block_simple_certificate'), $url);
$editnode->make_active();
echo $OUTPUT->header();

//To get all certificates must put courseid null and all=true
$certificates = block_simple_certificate::get_issued_certificates($uid, NULL);
$renderer = $PAGE->get_renderer('block_simple_certificate');
$content = $renderer->simple_certificate_tree($certificates, true, true);

echo $OUTPUT->box($content);
echo $OUTPUT->footer();
