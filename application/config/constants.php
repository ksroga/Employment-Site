<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
|--------------------------------------------------------------------------
| Custom Variables / Defines
|--------------------------------------------------------------------------
*/

defined('PASS_SALT_LENGTH')				OR define('PASS_SALT_LENGTH', 3); // length of random chars at the beginning and end of the md5 password (for safety reasons)


defined('PERM_ACP_ACCESS')				OR define('PERM_ACP_ACCESS', 'a'); // admin control panel perm
defined('PERM_POSTS_MANAGEMENT')		OR define('PERM_POSTS_MANAGEMENT', 'b'); // posts management perm
defined('PERM_OFFERS_MANAGEMENT')		OR define('PERM_OFFERS_MANAGEMENT', 'c'); // offers management perm
defined('PERM_GROUPS_MANAGEMENT')		OR define('PERM_GROUPS_MANAGEMENT', 'd'); // groups management perm
defined('PERM_USERS_MANAGEMENT')		OR define('PERM_USERS_MANAGEMENT', 'e'); // users management perm
defined('PERM_SETTINGS_CHANGE')			OR define('PERM_SETTINGS_CHANGE', 'f'); // change settings perm
defined('PERM_OFFERS_EDIT')				OR define('PERM_OFFERS_EDIT', 'g'); // offers edit (without acp) perm


defined('LOG_ADMIN_LOGIN') 					OR define('LOG_ADMIN_LOGIN', 1); // login to acp
defined('LOG_ADMIN_LOGOUT') 				OR define('LOG_ADMIN_LOGOUT', 2); // logout from acp
defined('LOG_ADMIN_GROUP_ADD') 				OR define('LOG_ADMIN_GROUP_ADD', 3);
defined('LOG_ADMIN_GROUP_DELETE')			OR define('LOG_ADMIN_GROUP_DELETE', 4);
defined('LOG_ADMIN_OFFER_EDIT')				OR define('LOG_ADMIN_OFFER_EDIT', 5);
defined('LOG_ADMIN_OFFER_STATUS_CHANGE') 	OR define('LOG_ADMIN_OFFER_STATUS_CHANGE', 6);	
defined('LOG_ADMIN_POST_ACCEPT')			OR define('LOG_ADMIN_POST_ACCEPT', 7);
defined('LOG_ADMIN_POST_DECLINE')			OR define('LOG_ADMIN_POST_DECLINE', 8);
defined('LOG_ADMIN_USER_ADD')				OR define('LOG_ADMIN_USER_ADD', 9);
defined('LOG_ADMIN_USER_EDIT')				OR define('LOG_ADMIN_USER_EDIT', 10);
defined("LOG_ADMIN_USER_BLOCK")				OR define('LOG_ADMIN_USER_BLOCK', 11);
defined("LOG_ADMIN_USER_UNBLOCK")			OR define('LOG_ADMIN_USER_UNBLOCK', 12);

defined('LOG_USER_LOGIN')					OR define('LOG_USER_LOGIN', 13);
defined('LOG_USER_LOGOUT')					OR define('LOG_USER_LOGOUT', 14);
defined('LOG_USER_LOGIN_BAD_DATA')			OR define('LOG_USER_LOGIN_BAD_DATA', 15);			
