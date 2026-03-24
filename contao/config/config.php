<?php
use Contao\ArrayUtil;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;
/**
 * Contao Open Source CMS - tags extension
 *
 * Copyright (c) 2008-2016 Helmut Schottmüller
 *
 * @license LGPL-3.0+
 */

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_tag'] = 'VHUG\ContaoTags\TagModel';

/**
 * Form fields
 */
$GLOBALS['BE_FFL']['tag'] = 'VHUG\ContaoTags\TagField';

/**
 * Front end modules
 */
ArrayUtil::arrayInsert($GLOBALS['FE_MOD']['tags'], 1, array
(
	'tagcloud'            => 'VHUG\ContaoTags\ModuleTagCloud',
  'tagcloudarticles'    => 'VHUG\ContaoTags\ModuleTagCloudArticles',
	'taggedArticleList'   => 'VHUG\ContaoTags\ModuleTaggedArticleList',
  'tagscope'            => 'VHUG\ContaoTags\ModuleTagScope',
  'tagcontentlist'      => 'VHUG\ContaoTags\ModuleTagContentList',
  'taglistbycategory'   => 'VHUG\ContaoTags\ModuleTagListByCategory',
  'tagcloudcontent'     => 'VHUG\ContaoTags\ModuleTagCloudContent',
  'tagcloudevents'      => 'VHUG\ContaoTags\ModuleTagCloudEvents',
  'tagcloudmembers'     => 'VHUG\ContaoTags\ModuleTagCloudMembers',
  'tagcloudnews'        => 'VHUG\ContaoTags\ModuleTagCloudNews'
));
ArrayUtil::arrayInsert($GLOBALS['FE_MOD']['miscellaneous'], 3, array
(
	'globalArticleList'    => 'VHUG\ContaoTags\ModuleGlobalArticlelist'
));

$GLOBALS['FE_MOD']['news']['newslist'] = 'VHUG\ContaoTags\ModuleNewsListTags';
$GLOBALS['FE_MOD']['news']['newsarchive'] = 'VHUG\ContaoTags\ModuleNewsArchiveTags';
$GLOBALS['FE_MOD']['news']['newsreader'] = 'VHUG\ContaoTags\ModuleNewsReaderTags';
$GLOBALS['FE_MOD']['events']['calendar'] = 'VHUG\ContaoTags\ModuleCalendarTags';
$GLOBALS['FE_MOD']['events']['eventlist'] = 'VHUG\ContaoTags\ModuleEventlistTags';
$GLOBALS['FE_MOD']['events']['eventreader'] = 'VHUG\ContaoTags\ModuleEventReaderTags';
$GLOBALS['FE_MOD']['faq']['faqlist'] = 'VHUG\ContaoTags\ModuleFaqListTags';

if (array_key_exists('last_events', $GLOBALS['FE_MOD']['events']))
{
	// add support for last_events extension
	$GLOBALS['FE_MOD']['events']['last_events'] = 'VHUG\ContaoTags\ModuleLastEventsTags';
}

/**
 * Content elements
	*/
$GLOBALS['TL_CTE']['texts']['headline'] = 'VHUG\ContaoTags\ContentHeadlineTags';
$GLOBALS['TL_CTE']['media']['gallery'] = 'VHUG\ContaoTags\ContentGalleryTags';
$isBackend = System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(System::getContainer ()->get('request_stack')->getCurrentRequest() ?? Request::create(''));
if ($isBackend)
{
	/**
	 * CSS files
	 */

    if (isset($GLOBALS['TL_CSS']) && \is_array($GLOBALS['TL_CSS']))
	{
		ArrayUtil::arrayInsert($GLOBALS['TL_CSS'], 1, 'bundles/contaotags/tag.css');
	}
	else
	{
		$GLOBALS['TL_CSS'] = array('bundles/contaotags/tag.css');
	}

	/**
	 * JavaScript files
	 */
    if (isset($GLOBALS['TL_JAVASCRIPT']) && \is_array($GLOBALS['TL_JAVASCRIPT']))
    {
        ArrayUtil::arrayInsert($GLOBALS['TL_JAVASCRIPT'], 1, 'bundles/contaotags/tag.js');
    }
    else
    {
        $GLOBALS['TL_JAVASCRIPT'] = array('bundles/contaotags/tag.js');
    }
}

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['reviseTable'][] = array('VHUG\ContaoTags\TagHelper', 'deleteIncompleteRecords');
$GLOBALS['TL_HOOKS']['reviseTable'][] = array('VHUG\ContaoTags\TagHelper', 'deleteUnusedTagsForTable');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('VHUG\ContaoTags\TagHelper', 'replaceTagInsertTags');
$GLOBALS['TL_HOOKS']['parseArticles'][] = array('VHUG\ContaoTags\TagHelper', 'parseArticlesHook');
$GLOBALS['TL_HOOKS']['compileArticle'][] = array('VHUG\ContaoTags\TagHelper', 'compileArticleHook');
$GLOBALS['TL_HOOKS']['setMemberlistOptions'][] = array('VHUG\ContaoTags\TagMemberHelper', 'setMemberlistOptions');

/**
* source tables that have tags enabled
*/
$GLOBALS['tags_extension']['sourcetable'][] = 'tl_article';
$GLOBALS['tags_extension']['sourcetable'][] = 'tl_calendar_events';
$GLOBALS['tags_extension']['sourcetable'][] = 'tl_content';
$GLOBALS['tags_extension']['sourcetable'][] = 'tl_news';
$GLOBALS['tags_extension']['sourcetable'][] = 'tl_member';
$GLOBALS['tags_extension']['sourcetable'][] = 'tl_faq';
$GLOBALS['tags_extension']['sourcetable'][] = 'fl_files';

/**
* Add 'tag' to the URL keywords to prevent problems with URL manipulating modules like folderurl
*/
if (isset($GLOBALS['TL_CONFIG']['urlKeywords'])) {
	$GLOBALS['TL_CONFIG']['urlKeywords'] .= (strlen(trim($GLOBALS['TL_CONFIG']['urlKeywords'])) ? ',' : '') . 'tag';
} else {
	$GLOBALS['TL_CONFIG']['urlKeywords'] = 'tag';
}
$GLOBALS['tags']['showInFeeds'] = true;

$GLOBALS['TL_FFL']['tag'] = 'VHUG\ContaoTags\TagFieldMemberFrontend';


//TO BE REMOVED, WE DON'T NEED CRON JOBS FOR OUR USE CASE
// if (is_array($GLOBALS['TL_CRON']['daily']))
// {
// 	foreach ($GLOBALS['TL_CRON']['daily'] as $key => $arr)
// 	{
// 		if (is_array($arr) && strcmp($arr[0], 'Calendar') == 0 && strcmp($arr[1], 'generateFeeds') == 0)
// 		{
// 			// Fix calendar feed cron job
// 			$GLOBALS['TL_CRON']['daily'][$key] = array('CalendarTags', 'generateFeeds');
// 		}
// 		if (is_array($arr) && strcmp($arr[0], 'News') == 0 && strcmp($arr[1], 'generateFeeds') == 0)
// 		{
// 			// Fix news feed cron job
// 			$GLOBALS['TL_CRON']['daily'][$key] = array('NewsTags', 'generateFeeds');
// 		}
// 	}
// }
