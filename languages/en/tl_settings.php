<?php
use Contao\System;
$rootDir = System::getContainer()->getParameter('kernel.project_dir');

if (!defined($rootDir)) die('You can not access this file directly!');


/**
 * PHP version 5
 * @copyright  Helmut Schottmüller 2010
 * @author     Helmut Schottmüller <https://github.com/hschottm>
 * @package    memberextensions
 * @license    LGPL
 * @filesource
 */

$GLOBALS['TL_LANG']['tl_settings']['disabledTagObjects']    = array('Disabled tag source tables', 'Check all source tables that should not have a tag input field in the backend.');
$GLOBALS['TL_LANG']['tl_settings']['tags_legend']    = 'Tags settings';

?>