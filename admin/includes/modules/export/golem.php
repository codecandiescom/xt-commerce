<?php
/* -----------------------------------------------------------------------------------------
   $Id: golem.php,v 1.2 2004/05/08 10:11:01 fanta2k Exp $

   XT-Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2003 XT-Commerce
   -----------------------------------------------------------------------------------------
   based on: 
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(cod.php,v 1.28 2003/02/14); www.oscommerce.com 
   (c) 2003	 nextcommerce (invoice.php,v 1.6 2003/08/24); www.nextcommerce.org

   Released under the GNU General Public License 
   ---------------------------------------------------------------------------------------*/


define('MODULE_GOLEM_TEXT_DESCRIPTION', 'Export - Golem.de (XML)<br><b>Format:</b><br>');
define('MODULE_GOLEM_TEXT_TITLE', 'Golem.de - XML');
define('MODULE_GOLEM_FILE_TITLE' , '<hr noshade>Dateiname');
define('MODULE_GOLEM_FILE_DESC' , 'Geben Sie einen Dateinamen ein, falls die Exportadatei am Server gespeichert werden soll.<br>(Verzeichnis export/)');
define('MODULE_GOLEM_STATUS_DESC','Modulstatus');
define('MODULE_GOLEM_STATUS_TITLE','Status');
define('MODULE_GOLEM_CURRENCY_TITLE','W�hrung');
define('MODULE_GOLEM_CURRENCY_DESC','Welche W�hrung soll exportiert werden?');
define('EXPORT_YES','Nur Herunterladen');
define('EXPORT_NO','Am Server Speichern');
define('CURRENCY','<hr noshade><b>W�hrung:</b>');
define('CURRENCY_DESC','W�hrung in der Exportdatei');
define('EXPORT','Bitte den Sicherungsprozess AUF KEINEN FALL unterbrechen. Dieser kann einige Minuten in Anspruch nehmen.');
define('EXPORT_TYPE','<hr noshade><b>Speicherart:</b>');
define('EXPORT_STATUS_TYPE','<hr noshade><b>Kundengruppe:</b>');
define('EXPORT_STATUS','Bitte w�hlen Sie die Kundengruppe, die Basis f�r den Exportierten Preis bildet. (Falls Sie keine Kundengruppenpreise haben, w�hlen Sie <i>Gast</i>):</b>');
define('CHARSET','iso-8859-1');
// include needed functions


  class golem {
    var $code, $title, $description, $enabled;


    function golem() {
      global $order;

      $this->code = 'golem';
      $this->title = MODULE_GOLEM_TEXT_TITLE;
      $this->description = MODULE_GOLEM_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_GOLEM_SORT_ORDER;
      $this->enabled = ((MODULE_GOLEM_STATUS == 'True') ? true : false);

    }


    function process($file) {

        @xtc_set_time_limit(0);
        require(DIR_FS_CATALOG.DIR_WS_CLASSES . 'xtcPrice.php');
        $xtPrice = new xtcPrice($_POST['currencies'],$_POST['status']);

                $schema = '<?xml version="1.0" encoding="' . CHARSET . '"?>' . "\n".
                     '<doc>' . "\n";
        $export_query =xtc_db_query("SELECT
                             p.products_id,
                             pd.products_name,
                             pd.products_description,
                             p.products_model,
                             p.products_image,
                             p.products_price,
                             p.products_status,
                             p.products_quantity,
                             p.products_shippingtime,
                             p.products_discount_allowed,
                             p.products_tax_class_id,
                             p.products_date_added,
                             m.manufacturers_name
                         FROM
                             " . TABLE_PRODUCTS . " p LEFT JOIN
                             " . TABLE_MANUFACTURERS . " m
                           ON p.manufacturers_id = m.manufacturers_id LEFT JOIN
                             " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           ON p.products_id = pd.products_id AND
                            pd.language_id = '".$_SESSION['languages_id']."' LEFT JOIN
                             " . TABLE_SPECIALS . " s
                           ON p.products_id = s.products_id
                         WHERE
                           p.products_status = 1
                         ORDER BY
                            p.products_date_added DESC,
                            pd.products_name");


        while ($products = xtc_db_fetch_array($export_query)) {

           $products_price = $xtPrice->xtcGetPrice($products['products_id'],
                                        $format=false,
                                        1,
                                        $products['products_tax_class_id'],
                                        '');
            // remove trash
            $products_description = strip_tags($products['products_description']);
            $products_description = substr($products_description, 0, 197) . '..';
             $products_description = str_replace(";",", ",$products_description);
            $products_description = str_replace("'",", ",$products_description);
            $products_description = str_replace("\n"," ",$products_description);
            $products_description = str_replace("\r"," ",$products_description);
            $products_description = str_replace("\t"," ",$products_description);
            $products_description = str_replace("\v"," ",$products_description);
            $products_description = str_replace("&quot,"," \"",$products_description);
            $products_description = str_replace("&qout,"," \"",$products_description);

            // get product categorie
            $categorie_query=xtc_db_query("SELECT
                                            categories_id
                                            FROM ".TABLE_PRODUCTS_TO_CATEGORIES."
                                            WHERE products_id='".$products['products_id']."'");
             while ($categorie_data=xtc_db_fetch_array($categorie_query)) {
                    $categories=$categorie_data['categories_id'];
             }
             $categorie_query=xtc_db_query("SELECT
                                            categories_name
                                            FROM ".TABLE_CATEGORIES_DESCRIPTION."
                                            WHERE categories_id='".$categories."'
                                            and language_id='".$_SESSION['languages_id']."'");
             $categorie_data=xtc_db_fetch_array($categorie_query);

            $tax_rate=xtc_get_tax_rate($products['products_tax_class_id']);

            //create content

            $schema .= '<product>' . "\n";

            $schema .= '<group>' . $categorie_data['categories_name']. '</group>' . "\n";
            $schema .= '<pid>' . $products['products_model'] . '</pid>' . "\n";
            $schema .= '<name>' . $products['products_name']  . '</name>' . "\n";
            $schema .= '<manufacturer>' . $products['manufacturers_name']. '</manufacturer>' . "\n";
            $schema .= '<description>' . $products_description . '</description>' . "\n";
            $schema .= '<ean></ean>' . "\n";
            $schema .= '<prices>' . "\n";
                    $schema .= '<price>' . "\n";
                        $schema .= '<currency>' . $_POST['currencies'] . '</currency>' . "\n";
                        $schema .= '<extax>' .round(($products_price/($tax_rate+100)*100),2) . '</extax>' . "\n";
                        $schema .= '<inctax>' . $products_price . '</inctax>' . "\n";
            		$schema .= '</price>' . "\n";
            $schema .= '</prices>' . "\n";

            $schema .= '<availability>' . $products['products_quantity'] . '</availability>' . "\n";
            $schema .= '<url>' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'product_info.php?products_id=' . $products['products_id'] . '</url>' . "\n";


            $schema .= '</product>' . "\n";

      
        }
        $schema .= '</doc>' . "\n";
        // create File
          $fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/' . $file, "w+");
          fputs($fp, $schema);
          fclose($fp);


      switch ($_POST['export']) {
        case 'yes':
            // send File to Browser
            $extension = substr($file, -3);
            $fp = fopen(DIR_FS_DOCUMENT_ROOT.'export/' . $file,"rb");
            $buffer = fread($fp, filesize(DIR_FS_DOCUMENT_ROOT.'export/' . $file));
            fclose($fp);
            header('Content-type: application/x-octet-stream');
            header('Content-disposition: attachment; filename=' . $file);
            echo $buffer;
            exit;

        break;
        }

    }

    function display() {

    $customers_statuses_array = xtc_get_customers_statuses();

    // build Currency Select
    $curr='';
    $currencies=xtc_db_query("SELECT code FROM ".TABLE_CURRENCIES);
    while ($currencies_data=xtc_db_fetch_array($currencies)) {
     $curr.=xtc_draw_radio_field('currencies', $currencies_data['code'],true).$currencies_data['code'].'<br>';
    }

    return array('text' =>  EXPORT_STATUS_TYPE.'<br>'.
                          	EXPORT_STATUS.'<br>'.
                          	xtc_draw_pull_down_menu('status',$customers_statuses_array, '1').'<br>'.
                            CURRENCY.'<br>'.
                            CURRENCY_DESC.'<br>'.
                            $curr.
                            EXPORT_TYPE.'<br>'.
                            EXPORT.'<br>'.
                          	xtc_draw_radio_field('export', 'no',false).EXPORT_NO.'<br>'.
                            xtc_draw_radio_field('export', 'yes',true).EXPORT_YES.'<br>'.
                            '<br>' . xtc_image_submit('button_export.gif', IMAGE_UPDATE) .

                            '<a href="' . xtc_href_link(FILENAME_MODULE_EXPORT, 'set=' . $_GET['set'] . '&module=golem') . '">' .
                            xtc_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');


    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = xtc_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_GOLEM_STATUS'");
        $this->_check = xtc_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) values ('MODULE_GOLEM_FILE', 'golem.xml',  '6', '1', '', now())");
      xtc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_key, configuration_value,  configuration_group_id, sort_order, set_function, date_added) values ('MODULE_GOLEM_STATUS', 'True',  '6', '1', 'xtc_cfg_select_option(array(\'True\', \'False\'), ', now())");
}

    function remove() {
      xtc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_GOLEM_STATUS','MODULE_GOLEM_FILE');
    }

  }
?>