<?php
/* -----------------------------------------------------------------------------------------
   $Id: specials.php,v 1.1 2004/04/26 20:26:42 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(specials.php,v 1.30 2003/02/10); www.oscommerce.com 
   (c) 2003	 nextcommerce (specials.php,v 1.10 2003/08/17); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/
$box_smarty = new smarty;
$box_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/'); 
$box_content='';
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_random_select.inc.php');

      //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') {
  $fsk_lock=' and p.products_fsk18!=1';
  }
  if (GROUP_CHECK=='true') {
   $group_check="and p.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";
  }
  if ($random_product = xtc_random_select("select
                                           p.products_id,
                                           pd.products_name,
                                           p.products_price,
                                           p.products_tax_class_id,
                                           p.products_image,
                                           s.expires_date,
                                           s.specials_new_products_price
                                           from " . TABLE_PRODUCTS . " p,
                                           " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                           " . TABLE_SPECIALS .
                                           " s where p.products_status = '1'
                                           and p.products_id = s.products_id
                                           and pd.products_id = s.products_id ".$fsk_lock."
                                           and pd.language_id = '" . $_SESSION['languages_id'] . "'
                                           and s.status = '1'
                                           ".$group_check."
                                           ".$fsk_lock."                                             
                                           order by s.specials_date_added
                                           desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {

  }
  $image='';
  if ($random_product['products_image']!='') $image=DIR_WS_THUMBNAIL_IMAGES . $random_product['products_image'];
  $SEF_parameter='';
    if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') $SEF_parameter='&product='.xtc_cleanName($random_product['categories_name']); 
    
    $box_smarty->assign('LINK',xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"].$SEF_parameter));
    $box_smarty->assign('IMAGE',$image);
    $box_smarty->assign('NAME',$random_product['products_name']);
    $box_smarty->assign('PRICE',$xtPrice->xtcGetPrice($random_product['products_id'],$format=true,1,$random_product['products_tax_class_id'],$random_product['products_price']));
    $box_smarty->assign('EXPIRES',$random_product['expires_date']);
    $box_smarty->assign('SPECIALS_LINK',xtc_href_link(FILENAME_SPECIALS));


	$box_smarty->assign('language', $_SESSION['language']);
  if ($random_product["products_id"]!='') {
       	  // set cache ID
  if (USE_CACHE=='false') {
  $box_smarty->caching = 0;
  $box_specials= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_specials.html');
  } else {
  $box_smarty->caching = 1;	
  $box_smarty->cache_lifetime=CACHE_LIFETIME;
  $box_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$random_product["products_id"].$_SESSION['customers_status']['customers_status_name'];
  $box_specials= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_specials.html',$cache_id);
  }
    $box_specials= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_specials.html');
    $smarty->assign('box_SPECIALS',$box_specials);
   } 
    ?>