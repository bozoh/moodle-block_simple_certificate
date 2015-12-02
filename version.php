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
 * Version details
 *
 * @package    block_simple_certificate
 * @author	   Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2015120229;        // The current plugin version (Date: YYYYMMDDXX)
$plugin->requires  = 2015041700;        // Requires this Moodle version
$plugin->component = 'block_simple_certificate';      // Full name of the plugin (used for diagnostics)
$plugin->dependencies = array('mod_simplecertificate'=>2015061729);
$plugin->release  = '1.0.2';       // Human-friendly version name
//MATURITY_ALPHA, MATURITY_BETA, MATURITY_RC, MATURITY_STABLE
$plugin->maturity = MATURITY_STABLE;
