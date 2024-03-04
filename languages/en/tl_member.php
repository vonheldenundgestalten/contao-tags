<?php 
use Contao\System;
$rootDir = System::getContainer()->getParameter('kernel.project_dir');

if (!defined($rootDir)) die('You can not access this file directly!');


/**
 * @copyright  Helmut Schottmüller 2009
 * @author     Helmut Schottmüller <https://github.com/hschottm>
 * @package    tags
 * @license    LGPL
 * @filesource
 */


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_member']['categories_legend']    = 'Categories';

?>
