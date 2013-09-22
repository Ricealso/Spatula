<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
extract($_POST);
if ($type == "login")
{
	$uid = user_authenticate($username, $password);
	if ($uid)
	{
		$arr0 = array('uid' => $uid,
		'type' => $type,
		'success' => 1);
	}
	else
	{
		$arr0 = array('uid' => $uid,
		'type' => $type,
		'success' => 0);
	}	
	echo json_encode($arr0);
}
else if ($type == "signup")
{
	$from = variable_get('site_mail',ini_get('sendmail_from'));
	$curUser = user_save('', array( 'name' => $user, 'pass' => $pass, 'mail' => $mail, 'roles' => array()));
	if ($curUser->uid > 0){
	$arr0 = array('uid' => $curUser->uid, 'type' => $type, 'success' => 1);}
	else
	$arr0 = array('uid' => 0, 'type' => $type, 'success' => 0);
	echo json_encode($arr0);
}
else
{
$arr0 = array('uid' => 0, 'type' => "Unknown", 'success' => 0);
echo json_encode($arr0);
}