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

/**
 * Form for editing simple_certificate block instances.
 * 
 * @package block_simple_certificate
 * @author Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

defined('MOODLE_INTERNAL') || die();

class block_simple_certificate extends block_base {
    
    private $certs;

    public function init() {
        $this->title = get_string('configtitle', 'block_simple_certificate');
    }

    public function has_config() {
        return true;
    }

    public function applicable_formats() {
        return array('all' => true);
    }

    public function instance_allow_multiple() {
        return false;
    }

    /**
     * Get certificates of an user, if numcertsshow config attributes is set and all = false
     * return only numcertsshow first certificates.
     * If courseid is not null, only returns certificate from that course
     * 
     * @param mixed $userid user id or user object
     * @param mixed $courseid course id or course object, only returns certificate from that course default null
     * @return List with all users valid certificates
     */
    
    public static function get_issued_certificates($userid = null, $courseid = null) {
        global $CFG, $DB;
        
        if (is_object($userid)) {
            $userid = $userid->id;
        }
        
        if (!empty($courseid)) {
            if (is_object($courseid)) {
                $courseid = $courseid->id;
            }
            if ($courseid === SITEID) {
                $courseid = null;
            }
        }
        $certs = null;
        
        if (!empty($courseid)) {
            // Make a join with simplecertificate table, withi courseid column
            $certs = $DB->get_records_sql(
                                        'SELECT sci.* FROM {simplecertificate_issues} sci INNER JOIN {simplecertificate} sc
                        ON sc.id=sci.certificateid WHERE sci.timedeleted IS NULL 
                        AND sci.userid = ? AND sc.course = ? ORDER BY sci.timecreated', 
                                        array($userid, $courseid));
        
        } else {
            // No courseid specified
            $certs = $DB->get_records_sql(
                                        'SELECT sci.* FROM {simplecertificate_issues} sci INNER JOIN {simplecertificate} sc
                        ON sc.id=sci.certificateid INNER JOIN {course} c ON sc.course=c.id WHERE sci.timedeleted IS NULL
                        AND sci.userid = ? ORDER BY c.fullname, sci.timecreated', 
                                        array($userid, $courseid));
        
        }
        return $certs;
    }

    function get_content() {
        global $CFG, $USER, $COURSE;
        
        if ($this->content !== NULL) {
            return $this->content;
        }
        
        if (isloggedin() && !isguestuser()) { // Show the block
            $certs = self::get_issued_certificates($USER->id, $COURSE->id);
            $this->content = new stdClass();
            $renderer = $this->page->get_renderer('block_simple_certificate');
            
            if (SITEID === $COURSE->id) {
                $showcourse = true;
            } else {
                $showcourse = false;
            }
            
            $this->content->text = $renderer->block_simple_certificate_tree($certs, false, $showcourse);
            if (!empty($certs)) {
                $url = new moodle_url("$CFG->wwwroot/blocks/simple_certificate/view.php");
                $url->param("uid", $USER->id);
                $url->param("cid", $COURSE->id);
                $this->content->footer = html_writer::link($url, get_string('allcertificate', 'block_simple_certificate'));
            }
        }
        return $this->content;
    }

    /**
     * The block should only be dockable when the title of the block is not empty
     * and when parent allows docking.
     * 
     * @return bool
     */
    public function instance_can_be_docked() {
        return (!empty($this->config->title) && parent::instance_can_be_docked());
    }
}
