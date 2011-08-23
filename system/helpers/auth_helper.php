<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Code Igniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		Rick Ellis
 * @copyright	Copyright (c) 2006, pMachine, Inc.
 * @license		http://www.codeigniter.com/user_guide/license.html 
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * Sentry Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Security
 * @author      Chris Schletter
 * @copyright   Copyright (c) 2006, thZero.com
 * @license     see Sentry License.txt included with the package
 */

// ------------------------------------------------------------------------
    define('AUTH_VERSION', '0.8.9');

    define('AUTH_COOKIE_AUTOLOGIN', 'sentry_auto_login');
    define('AUTH_SECURITY_ROLE', 'role');
    define('AUTH_SECURITY_ROLE_ID', 'role_id');
    define('AUTH_SECURITY_ROLE_NAME', 'role');
    define('AUTH_SECURITY_PERMISSION_ID', 'permission_id');
    define('AUTH_SECURITY_PERMISSION_NAME', 'permission');
    define('AUTH_SECURITY_PERMISSIONS', 'permissions');
    define('AUTH_SECURITY_USER_ID', 'user_id');
    define('AUTH_SECURITY_USER_NAME', 'user_name');
    define('AUTH_SECURITY_USERS', 'users');
    define('AUTH_SECURITY_SECURITY', 'security');
    define('AUTH_STATUS', 'sentry_status');
//
// Returns the currently logged on user's name.
// Returns an empty string if no user is logged in.
//
function getUserName()
{
    $obj =& get_instance();
	$obj->lang->load('sentry');
    return $obj->authlib->getUserName();
}

//
// Returns the currently logged on user's role.
// Returns an empty string if no user is logged in.
//
function getSecurityRole()
{
    $obj =& get_instance();
	$obj->lang->load('sentry');
    return $obj->authlib->getSecurityRole();
}

//
// Returns the currently logged on user's role id.
// Returns an -1 if no user is logged in.
//
function getSecurityRoleId()
{
    $obj =& get_instance();
	$obj->lang->load('sentry');
    return $obj->authlib->getSecurityRoleId();
}

//
// Checks to see if a user has an explicit permission.  
// Returns true if sentry system is not activated.
// Returns the true if the permission is granted, otherwise false.
//
function hasPermission($permission_id)
{
	$obj =& get_instance();
	$this->lang->load('sentry');
    return $obj->authlib->hasPermission($permission_id);
}

//
// Checks to see if a user is an administrator.  
// Returns true if sentry system is not activated.
// Returns true if admin, otherwise false.
//
function isAdmin()
{
    $obj =& get_instance();
	$obj->lang->load('sentry');
    $obj->load->load->library('Authlib'); 
    return $obj->authlib->isAdmin();
}

//
// Checks to see if a user is logged in.  
// Returns true if sentry system is not activated.
// Returns the user_id if valid, otherwise false.
//
function isValidUser()
{
    $obj =& get_instance();
	$obj->lang->load('sentry');
    $obj->load->load->library('Authlib'); 
    return $obj->authlib->isValidUser();
}

function loginAnchor($logout_attributes = null, $login_attributes = null)
{
    $obj =& get_instance();
	$obj->lang->load('sentry');
	return (isValidUser() ? anchor('auth/logout', $obj->lang->line('auth_logout_label'), $logout_attributes) : anchor('auth/index', $obj->lang->line('sentry_login_label'), $login_attributes));
}
?>
