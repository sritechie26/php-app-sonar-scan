CiviCRM CiviAuthenticate Plugin
===============================

Authentication plugin for Joomla which allows you to restrict frontend login access based on whether the user is a member in good standing and various other criteria.

In addition to creating membership-status-based access criteria, the user can configure the plugin to assign a Joomla Access Level based on the membership status or type, allow login using username (standard) or email address (alternate), and control where the user is redirected based on various status combinations.

See also: http://wiki.civicrm.org/confluence/display/CRMDOC/Joomla+CiviCRM+Membership+Authentication+and+ACL+Plugin


Adding/Removing additional Membership Status or Membership Type Levels :
-----------------------------------------------------------------------

By default the plugin is hard coded for 18 Membership Status Levels and 10 Membership Type Levels. You can add additional levels by modifying the following files:

Note:
This plugin uses only few user groups in joomla (as I was having this recruitment). if you want to add all the usergroups to be assigned, you can just make the changes in our  usergroup.php file(this is the copy of joomla core file I've changed according to my requirement).