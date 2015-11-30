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
 * Print Simple Certificate tree.
 * 
 * @package block_simple_certificate
 * @author Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Carlos Alexandre S. da Fonseca
 * @copyright 2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

defined('MOODLE_INTERNAL') || die();

class block_simple_certificate_renderer extends plugin_renderer_base {

    /**
     * Prints simple certificate tree view
     * 
     * @return string
     */
    public function block_simple_certificate_tree($certs, $all = false, $showcourse = false) {
        return $this->render(new simple_certificate_tree($certs, $all, $showcourse));
    }

    public function render_simple_certificate_tree(simple_certificate_tree $tree) {
        $module = array('name' => 'block_simple_certificate', 'fullpath' => '/blocks/simple_certificate/module.js', 
                'requires' => array('yui2-treeview'));
        if (empty($tree->node['courses'])) {
            $html = $this->output->box(get_string('nocertificate', 'block_simple_certificate'));
        } else {
            $htmlid = 'block_simple_certificate_tree_' . uniqid();
            $this->page->requires->js_init_call('M.block_simple_certificate.init_tree', array(false, $htmlid));
            $html = '<div id="' . $htmlid . '">';
            $html .= $this->htmllize_tree($tree, $tree->node);
            $html .= '</div>';
        }
        
        return $html;
    }

    /**
     * Internal function - creates htmls structure suitable for YUI tree.
     */
    protected function htmllize_tree($tree, $node) {
        global $CFG;
        
        $fs = get_file_storage();
        $yuiconfig = array();
        
        $numcertsshow = get_config('block_simple_certificate', 'numcertsshow');
        $yuiconfig['type'] = 'html';
        
        if (empty($node['courses'])) {
            return '';
        }
        $result = '<ul>';
        $coursecount = 0;
        foreach ($node['courses'] as $course) {
            if (empty($course['certs'])) {
                continue;
            }
            if ($tree->showcourse) {
                $coursecount++;
                if (!$tree->all && $coursecount > $numcertsshow) {
                    // Reach Courses to show limit
                    break;
                }
                $image = $this->output->pix_icon('i/course', $course['name'], 'moodle', array('class' => 'icon'));
                
                // Get course name
                $result .= '<li yuiConfig=\'' . json_encode($yuiconfig) . '\'><div>' . $image . s($course['name']) . '</div><ul>';
                // get course certs
            }
            foreach ($course['certs'] as $cert) {
                $certname = explode('-', $cert->certificatename, 2)[1];
                $image = $this->output->pix_icon('icon', $certname, 'mod_simplecertificate', array('class' => 'icon'));
                
                if ($fs->file_exists_by_hash($cert->pathnamehash)) {
                    $url = new moodle_url("$CFG->wwwroot/mod/simplecertificate/wmsendfile.php");
                    $url->param("id", $cert->id);
                    $url->param("sk", sesskey());
                    $result .= '<li yuiConfig=\'' . json_encode($yuiconfig) . '\'><div>' . html_writer::link($url, $image .
                     $certname) . '</div></li>';
                } else {
                    $result .= '<li yuiConfig=\'' . json_encode($yuiconfig) . '\'><div>' . html_writer::label($image . $certname) .
                     '</div></li>';
                }
            }
            if ($tree->showcourse) {
                $result .= '</ul></li>';
            }
        }
        $result .= '</ul>';
        
        return $result;
    }
}

class simple_certificate_tree implements renderable {
    public $node;
    public $all;
    public $showcourse;

    public function __construct($certs, $all, $shoecourse) {
        $this->node = $this->get_certs_tree($certs);
        $this->all = $all;
        $this->showcourse = $shoecourse;
    }

    function get_certs_tree($certs) {
        global $DB;
        
        if (empty($certs))
            return '';
        
        $result = '';
        
        foreach ($certs as $issuecert) {
            $str = explode('-', $issuecert->certificatename, 2);
            
            $coursename = $str[0];
            $certname = $str[1];
            if ($cert = $DB->get_record('simplecertificate', array('id' => $issuecert->certificateid))) {
                if ($course = get_course($cert->course)) {
                    $coursename = $course->fullname;
                }
            }
            
            if (!isset($result['courses'][$coursename])) {
                $result['courses'][$coursename] = array('name' => $coursename, 'certs' => array());
            }
            
            if (!isset($result['course'][$coursename]['certs'][$issuecert->code])) {
                $result['courses'][$coursename]['certs'][$issuecert->code] = $issuecert;
            }
        }
        
        return $result;
    }
}
