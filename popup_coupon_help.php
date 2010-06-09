<?php
/* -----------------------------------------------------------------------------------------
   $Id: popup_coupon_help_help.php,v 1.4 2004/06/03 15:07:35 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(popup_coupon_help.php,v 1.1.2.5 2003/05/02); www.oscommerce.com


   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/


  require('includes/application_top.php');
  require_once(DIR_FS_INC . 'xtc_date_short.inc.php');

  $smarty = new Smarty;

  include( 'includes/header.php');
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_POPUP_COUPON_HELP);

  $coupon_query = xtc_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cID'] . "'");
  $coupon = xtc_db_fetch_array($coupon_query);
  $coupon_desc_query = xtc_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cID'] . "' and language_id = '" . $_SESSION['language'] . "'");
  $coupon_desc = xtc_db_fetch_array($coupon_desc_query);
  $text_coupon_help = TEXT_COUPON_HELP_HEADER;
  $text_coupon_help .= sprintf(TEXT_COUPON_HELP_NAME, $coupon_desc['coupon_name']);
  if (xtc_not_null($coupon_desc['coupon_description'])) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DESC, $coupon_desc['coupon_description']);
  $coupon_amount = $coupon['coupon_amount'];
  switch ($coupon['coupon_type']) {
    case 'F':
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, $xtPrice->xtcFormat($coupon['coupon_amount'],true));
    break;
    case 'P':
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, number_format($coupon['coupon_amount'],2). '%');
    break;
    case 'S':
    $text_coupon_help .= TEXT_COUPON_HELP_FREESHIP;
    break;
    default:
  }

  if ($coupon['coupon_minimum_order'] > 0 ) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_MINORDER, $xtPrice->xtcFormat($coupon['coupon_minimum_order'],true));
  $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DATE, xtc_date_short($coupon['coupon_start_date']),xtc_date_short($coupon['coupon_expire_date']));
  $text_coupon_help .= '<b>' . TEXT_COUPON_HELP_RESTRICT . '</b>';
  $text_coupon_help .= '<br /><br />' .  TEXT_COUPON_HELP_CATEGORIES;
  $coupon_get=xtc_db_query("select restrict_to_categories from " . TABLE_COUPONS . " where coupon_id='".$_GET['cID']."'");
  $get_result=xtc_db_fetch_array($coupon_get);

  $cat_ids = split("[,]", $get_result['restrict_to_categories']);
  for ($i = 0; $i < count($cat_ids); $i++) {
    $result = mysql_query("SELECT * FROM categories, categories_description WHERE categories.categories_id = categories_description.categories_id and categories_description.language_id = '" . $_SESSION['language'] . "' and categories.categories_id='" . $cat_ids[$i] . "'");
    if ($row = mysql_fetch_array($result)) {
    $cats .= '<br />' . $row["categories_name"];
    } 
  }
  if ($cats=='') $cats = '<br />NONE';
  $text_coupon_help .= $cats;
  $text_coupon_help .= '<br /><br />' .  TEXT_COUPON_HELP_PRODUCTS;
  $coupon_get=xtc_db_query("select restrict_to_products from " . TABLE_COUPONS . "  where coupon_id='".$_GET['cID']."'");
  $get_result=xtc_db_fetch_array($coupon_get);

  $pr_ids = split("[,]", $get_result['restrict_to_products']);
  for ($i = 0; $i < count($pr_ids); $i++) {
    $result = mysql_query("SELECT * FROM products, products_description WHERE products.products_id = products_description.products_id and products_description.language_id = '" .$_SESSION['language'] . "'and products.products_id = '" . $pr_ids[$i] . "'");
    if ($row = mysql_fetch_array($result)) {
      $prods .= '<br />' . $row["products_name"];
    }
  }
  if ($prods=='') $prods = '<br />NONE';
  $text_coupon_help .= $prods;

  $smarty->assign('TEXT_HELP',$text_coupon_help);
  $smarty->assign('link_close','javascript:window.close()');
  $smarty->assign('language', $_SESSION['language']);


  $smarty->caching = 0;
  $smarty->display(CURRENT_TEMPLATE.'/module/popup_coupon_help.html');


?>