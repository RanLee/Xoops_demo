<?php
/**
 * Private Messages
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         pm
 * @since           2.4.0
 * @author          trabis <lusopoemas@gmail.com>
 * @version         $Id: core.php 12537 2014-05-19 14:19:33Z beckmi $
 */

// defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

/**
 * PM core preloads
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          trabis <lusopoemas@gmail.com>
 */
class PmCorePreload extends XoopsPreloadItem
{

    /**
     * @param $args
     */
    function eventCorePmliteStart($args)
    {
        header("location: ./modules/pm/pmlite.php" . (empty($_SERVER['QUERY_STRING']) ? "" : "?" . $_SERVER['QUERY_STRING']));
        exit();
    }

    /**
     * @param $args
     */
    function eventCoreReadpmsgStart($args)
    {
        header("location: ./modules/pm/readpmsg.php" . (empty($_SERVER['QUERY_STRING']) ? "" : "?" . $_SERVER['QUERY_STRING']));
        exit();
    }

    /**
     * @param $args
     */
    function eventCoreViewpmsgStart($args)
    {
        header("location: ./modules/pm/viewpmsg.php" . (empty($_SERVER['QUERY_STRING']) ? "" : "?" . $_SERVER['QUERY_STRING']));
        exit();
    }

    /**
     * @param $args
     */
    function eventCoreClassSmartyXoops_pluginsXoinboxcount($args)
    {
        $args[0] =& xoops_getModuleHandler('message', 'pm');
    }

}
