<?php
/* -----------------------------------------------------------------------------------------
   $Id: banners.php 4 2006-11-28 14:38:03Z mzanier $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


  require_once(DIR_FS_INC . 'xtc_banner_exists.inc.php');
  require_once(DIR_FS_INC . 'xtc_display_banner.inc.php');
  require_once(DIR_FS_INC . 'xtc_update_banner_display_count.inc.php');


  if ($banner = xtc_banner_exists('dynamic', 'banner')) {
  $smarty->assign('BANNER',xtc_display_banner('static', $banner));

  }
?>