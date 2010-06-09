<?php
/* -----------------------------------------------------------------------------------------
   $Id: address_book_details.php,v 1.6 2004/04/25 13:58:08 fanta2k Exp $   

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(address_book_details.php,v 1.9 2003/05/22); www.oscommerce.com 
   (c) 2003	 nextcommerce (address_book_details.php,v 1.9 2003/08/13); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------/-----*/

  // include needed functions
  $module_smarty=new Smarty;
  $module_smarty->assign('tpl_path','templates/'.CURRENT_TEMPLATE.'/');
  include_once('inc/xtc_get_zone_name.inc.php');
  include_once('inc/xtc_get_country_list.inc.php');
  include_once('inc/xtc_get_countries.inc.php');
  include_once('inc/xtc_draw_checkbox_field.inc.php'); 

  if (!isset($process)) $process = false;


  if (ACCOUNT_GENDER == 'true') {
    $male = ($entry['entry_gender'] == 'm') ? true : false;
    $female = ($entry['entry_gender'] == 'f') ? true : false;

  $module_smarty->assign('gender','1');
  $module_smarty->assign('INPUT_MALE',xtc_draw_radio_field('gender', 'm',$male));
  $module_smarty->assign('INPUT_FEMALE',xtc_draw_radio_field('gender', 'f',$female).(xtc_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''));


  }

  $module_smarty->assign('INPUT_FIRSTNAME',xtc_draw_input_field('firstname',$entry['entry_firstname']) . '&nbsp;' . (xtc_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''));
  $module_smarty->assign('INPUT_LASTNAME',xtc_draw_input_field('lastname',$entry['entry_lastname']) . '&nbsp;' . (xtc_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''));


  if (ACCOUNT_COMPANY == 'true') {
  $module_smarty->assign('company','1');
  $module_smarty->assign('INPUT_COMPANY',xtc_draw_input_field('company', $entry['entry_company']) . '&nbsp;' . (xtc_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''));


  }


$module_smarty->assign('INPUT_STREET',xtc_draw_input_field('street_address', $entry['entry_street_address']) . '&nbsp;' . (xtc_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''));

  if (ACCOUNT_SUBURB == 'true') {
  $module_smarty->assign('suburb','1');
  $module_smarty->assign('INPUT_SUBURB',xtc_draw_input_field('suburb', $entry['entry_suburb']) . '&nbsp;' . (xtc_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''));

  }
  $module_smarty->assign('INPUT_CODE',xtc_draw_input_field('postcode', $entry['entry_postcode']) . '&nbsp;' . (xtc_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''));
  $module_smarty->assign('INPUT_CITY',xtc_draw_input_field('city', $entry['entry_city']) . '&nbsp;' . (xtc_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''));

  if (ACCOUNT_STATE == 'true') {
  $module_smarty->assign('state','1');


    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = xtc_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . xtc_db_input($country) . "' order by zone_name");
        while ($zones_values = xtc_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        $state_input= xtc_draw_pull_down_menu('state', $zones_array);
      } else {
        $state_input= xtc_draw_input_field('state');
      }
    } else {
      $state_input= xtc_draw_input_field('state', xtc_get_zone_name($entry['entry_country_id'], $entry['entry_zone_id'], $entry['entry_state']));
    }

    if (xtc_not_null(ENTRY_STATE_TEXT)) $state_input.= '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;

  $module_smarty->assign('INPUT_STATE',$state_input);
  }

  if ($_POST['country']){
  $selected = $_POST['country'];
  }else{
  $selected = $entry['entry_country_id'];
  }

  $module_smarty->assign('SELECT_COUNTRY',xtc_get_country_list('country', $selected) . '&nbsp;' . (xtc_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''));

  if ((isset($_GET['edit']) && ($_SESSION['customer_default_address_id'] != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
  $module_smarty->assign('new','1');
  $module_smarty->assign('CHECKBOX_PRIMARY',xtc_draw_checkbox_field('primary', 'on', false, 'id="primary"'));

  }

  $module_smarty->assign('language', $_SESSION['language']);
  $module_smarty->caching = 0;
  $main_content=$module_smarty->fetch(CURRENT_TEMPLATE . '/module/address_book_details.html');
  $smarty->assign('MODULE_address_book_details',$main_content);
?>