<?php
/**
 * Generating an RSS feed
 *
 * @copyright	Madfish (Simon Wilkinson)
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		network
 * @version		$Id$
 */

/** Include the module's header for all pages */
include_once 'header.php';
include_once ICMS_ROOT_PATH . '/header.php';

/** To come soon in imBuilding...

$clean_post_uid = isset($_GET['uid']) ? intval($_GET['uid']) : FALSE;

$network_feed = new icms_feeds_Rss();

$network_feed->title = $icmsConfig['sitename'] . ' - ' . $icmsModule->name();
$network_feed->url = XOOPS_URL;
$network_feed->description = $icmsConfig['slogan'];
$network_feed->language = _LANGCODE;
$network_feed->charset = _CHARSET;
$network_feed->category = $icmsModule->name();

$network_post_handler = icms_getModuleHandler("post", basename(dirname(__FILE__)), "network");
//NetworkPostHandler::getPosts($start = 0, $limit = 0, $post_uid = FALSE, $year = FALSE, $month = FALSE
$postsArray = $network_post_handler->getPosts(0, 10, $clean_post_uid);

foreach($postsArray as $postArray) {
	$network_feed->feeds[] = array (
	  'title' => $postArray['post_title'],
	  'link' => str_replace('&', '&amp;', $postArray['itemUrl']),
	  'description' => htmlspecialchars(str_replace('&', '&amp;', $postArray['post_lead']), ENT_QUOTES),
	  'pubdate' => $postArray['post_published_date_int'],
	  'guid' => str_replace('&', '&amp;', $postArray['itemUrl']),
	);
}

$network_feed->render();
*/