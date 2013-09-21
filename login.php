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
$uid = user_authenticate($username, $password);
if ($uid)
{
$results = db_query('SELECT n.id, n.uid, n.name, n.exp, n.happiness
FROM {pet} n WHERE n.uid = :uid AND n.primary = 1', array(':uid' => $uid));
$i = 0;

foreach($results as $result)
{
$arr0 = array('petid' => $result->id,
'uid' => $result->uid,
'petname' => $result->name,
'experience' => $result->exp,
'happiness' => $result->happiness);
}
	echo json_encode($arr0);
	}
	else
	echo "0";