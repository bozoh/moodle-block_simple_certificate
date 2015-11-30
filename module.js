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
 * Init simple certificate treeview
 *
 * @package    block_simple_certificate
 * @author	   Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Carlos Alexandre S. da Fonseca
 * @copyright  2015 - Lesterhuis Training & Consultancy (thanks for support it)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

M.block_simple_certificate = {};

M.block_simple_certificate.init_tree = function(Y, expand_all, htmlid) {
	Y.use('yui2-treeview', function(Y) {
		var tree = new Y.YUI2.widget.TreeView(htmlid);

		tree.subscribe("clickEvent", function(node, event) {
			// We want normal clicking which redirects to url
			return false;
		});

		if (expand_all) {
			tree.expandAll();
		}
		tree.render();
	});
};
