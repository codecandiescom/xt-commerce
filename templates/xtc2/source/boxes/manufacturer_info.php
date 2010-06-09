<?php
/* -----------------------------------------------------------------------------------------
   $Id: manufacturer_info.php,v 1.1 2004/04/26 20:26:42 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(manufacturer_info.php,v 1.10 2003/02/12); www.oscommerce.com
   (c) 2003	 nextcommerce (manufacturer_info.php,v 1.6 2003/08/13); www.nextcommerce.org 

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
$box_smarty = new smarty;
$box_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
$box_content='';
  if (isset($_GET['products_id'])) {
    $manufacturer_query = xtc_db_query("select m.manufacturers_id, m.manufacturers_name, m.manufacturers_image, mi.manufacturers_url from " . TABLE_MANUFACTURERS . " m left join " . TABLE_MANUFACTURERS_INFO . " mi on (m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$_SESSION['languages_id'] . "'), " . TABLE_PRODUCTS . " p  where p.products_id = '" . (int)$_GET['products_id'] . "' and p.manufacturers_id = m.manufacturers_id");
    if (xtc_db_num_rows($manufacturer_query)) {
      $manufacturer = xtc_db_fetch_array($manufacturer_query);

      $image='';
      if (xtc_not_null($manufacturer['manufacturers_image'])) $image=DIR_WS_IMAGES . $manufacturer['manufacturers_image'];
      $box_smarty->assign('IMAGE',$image);
      $box_smarty->assign('NAME',$manufacturer['manufacturers_name']);
      $box_smarty->assign('URL','<a href="' . xtc_href_link(FILENAME_REDIRECT, 'action=manufacturer&manufacturers_id=' . $manufacturer['manufacturers_id']) . '" target="_blank">' . sprintf(BOX_MANUFACTURER_INFO_HOMEPAGE, $manufacturer['manufacturers_name']) . '</a>');
      $box_smarty->assign('LINK_MORE','<a href="' . xtc_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturer['manufacturers_id']) . '">' . BOX_MANUFACTURER_INFO_OTHER_PRODUCTS . '</a>');


    }
  }



 	$box_smarty->assign('language', $_SESSION['language']);
    	  // set cache ID
  if (USE_CACHE=='false') {
  $box_smarty->caching = 0;
  $box_manufacturers_info= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_manufacturers_info.html');
  } else {
  $box_smarty->caching = 1;	
  $box_smarty->cache_lifetime=CACHE_LIFETIME;
  $box_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$_GET['products_id'];
  $box_manufacturers_info= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_manufacturers_info.html',$cache_id);
  }
    if ($manufacturer['manufacturers_name']!='')  $smarty->assign('box_MANUFACTURERS_INFO',$box_manufacturers_info);
    
?>