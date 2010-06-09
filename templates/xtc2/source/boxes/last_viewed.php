<?php
/* -----------------------------------------------------------------------------------------
   $Id: last_viewed.php,v 1.0 2004/04/26 20:26:42 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/

$box_smarty = new smarty;
$box_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
$box_content='';

if (isset ($_SESSION[tracking][products_history][0])) {
  // include needed functions
  require_once(DIR_FS_INC . 'xtc_rand.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_path.inc.php');
  require_once(DIR_FS_INC . 'xtc_get_products_name.inc.php');	
$max = count($_SESSION[tracking][products_history]);
$max--;
$random_last_viewed = xtc_rand(0,$max);

  //fsk18 lock
  $fsk_lock='';
  if ($_SESSION['customers_status']['customers_fsk18_display']=='0') {
  $fsk_lock=' and p.products_fsk18!=1';
  }
     if (GROUP_CHECK=='true') {
       $group_check="and p.group_ids LIKE '%c_".$_SESSION['customers_status']['customers_status_id']."_group%'";

  }

    
                                  
       $random_query = "select p.products_id,
                                           pd.products_name,
                                           p.products_price,
                                           p.products_tax_class_id,
                                           p.products_image,
                                           p2c.categories_id,
                                           cd.categories_name 
                                           from 
                                           " . TABLE_PRODUCTS . " p,
                                           " . TABLE_PRODUCTS_DESCRIPTION . " pd,
                                           " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                                           " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                           where p.products_status = '1'                                                                                               
                                           and p.products_id = '".(int)$_SESSION[tracking][products_history][$random_last_viewed]."'
                                           and pd.products_id = '".(int)$_SESSION[tracking][products_history][$random_last_viewed]."'
                                           and p2c.products_id = '".(int)$_SESSION[tracking][products_history][$random_last_viewed]."'
                                           and pd.language_id = '" . $_SESSION['languages_id'] . "'
                                           and cd.categories_id = p2c.categories_id
                                           ".$group_check."
                                           ".$fsk_lock."
                                           and cd.language_id = '" . $_SESSION['languages_id'] . "'";

    $random_query = xtDBquery($random_query);
    $random_product = xtc_db_fetch_array(&$random_query,true);

    $random_products_price = $xtPrice->xtcGetPrice($random_product['products_id'],$format=true,1,$random_product['products_tax_class_id'],$random_product['products_price']);

    $category_path = xtc_get_path($random_product['categories_id']);

if ($random_product['products_name']!='') {

    $box_content='<a href="' . xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . xtc_image(DIR_WS_THUMBNAIL_IMAGES . $random_product['products_image'], $random_product['products_name'], PRODUCT_IMAGE_THUMBNAIL_WIDTH, PRODUCT_IMAGE_THUMBNAIL_HEIGHT) . '</a><br><a href="' . xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $random_products_price;

	$image='';
    if ($random_product['products_image']!='') {
    $image=DIR_WS_THUMBNAIL_IMAGES . $random_product['products_image'];
    }
	$SEF_parameter='';
    if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') $SEF_parameter='&'.xtc_cleanName($random_product['categories_name'],false).'='.xtc_cleanName($random_product['products_name']); 
    
    $box_smarty->assign('LINK',xtc_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"].$SEF_parameter));
    $box_smarty->assign('IMAGE',$image);
    $box_smarty->assign('NAME',$random_product['products_name']);
    $box_smarty->assign('PRICE',$random_products_price);
    $box_smarty->assign('BOX_CONTENT', $box_content);
    $box_smarty->assign('MY_PAGE', 'TEXT_MY_PAGE');
    $box_smarty->assign('WATCH_CATGORY', 'TEXT_WATCH_CATEGORY');
    $box_smarty->assign('MY_PERSONAL_PAGE',xtc_href_link(FILENAME_ACCOUNT));
    $SEF_parameter='';
    if (SEARCH_ENGINE_FRIENDLY_URLS == 'true') $SEF_parameter='&category='.xtc_cleanName($random_product['categories_name']); 
    
    $box_smarty->assign('CATEGORY_LINK',xtc_href_link(FILENAME_DEFAULT, $category_path.$SEF_parameter));
    $box_smarty->assign('CATEGORY_NAME',$random_product['categories_name']);
    $box_smarty->assign('language', $_SESSION['language']);

       	  // set cache ID
  if (USE_CACHE=='false') {
  $box_smarty->caching = 0;
  $box_last_viewed= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_last_viewed.html');
  } else {
  $box_smarty->caching = 1;	
  $box_smarty->cache_lifetime=CACHE_LIFETIME;
  $box_smarty->cache_modified_check=CACHE_CHECK;
  $cache_id = $_SESSION['language'].$random_product['products_id'].$_SESSION['customers_status']['customers_status_name'];
  $box_last_viewed= $box_smarty->fetch(CURRENT_TEMPLATE.'/boxes/box_last_viewed.html',$cache_id);
  }
    $smarty->assign('box_LAST_VIEWED',$box_last_viewed);
 }
}
    ?>