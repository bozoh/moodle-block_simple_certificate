QUICK INSTALL
=============

YOU MUST INSTALL MOD SIMPLE CERTIFICATE BEFORE INSTALL THIS ONE 
(https://github.com/bozoh/moodle-mod_simplecertificate)

There are two installation methods that are available. Follow one of these, then
log into your Moodle site as an administrator and visit the notifications page
to complete the install.


==================== MOST RECOMMENDED METHOD - Git ====================

If you do not have git installed, please see the below link. Please note, it is
not necessary to set up the SSH Keys. This is only needed if you are going to
create a repository of your own on github.com.

Information on installing git - http://help.github.com/set-up-git-redirect/

Once you have git installed, simply visit the Moodle blocks directory and clone
git://github.com/bozoh/moodle-block_simple_certificate.git, remember to
rename the folder to certificate, if you do not specify this in the clone command

Eg. Linux command line would be as follow -

git clone git://github.com/bozoh/moodle-block_simple_certificate.git simple_certificate

Once cloned, checkout the branch that is specific to your Moodle version.
eg, MOODLE_29, master for the last version) 

Use git pull to update this branch periodically to ensure you have the latest version.


==================== Download the simple certificate block. ====================

Visit https://github.com/bozoh/moodle-block_simple_certificate.git, choose the branch
that matches your Moodle version (eg. MOODLE_29 is for moodle 2.9) and download the zip, 
uncompress this zip and extract the folder. The folder will have a name similar to: 
bozoh-moodle-block_simple_certificate-c9fbadb, 

you MUST rename this to simple_certificate. Place this in the blocks folder in your moodle
directory.


Thanks to Lesterhuis Training & Consultancy for support it

