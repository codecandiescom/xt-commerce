<?php
    /*
        $Id: uos_gp.php 2006-07-13 15:20:00a $
        
   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   -----------------------------------------------------------------------------------------

        UNITES-ONLINE-SERVICES Payment interface
        @copyright 2006 by UNITES-ONLINE-SERVICES
        @subpackage uos_gp_modul
        @author o.reinhard<o.reinhard@united-online-services.de>

        Contribution based on:
        osCommerce, Open Source E-Commerce Solutions
        http://www.oscommerce.com

        Released under the GNU General Public License
    */

  define('MODULE_PAYMENT_UOS_GP_TEXT_TITLE', '<img src="https://www.united-online-transfer.com/images/_icon_global-paycard.gif" align="middle" > global-paycard&reg; (PrePaid Internet Konto)');
  define('MODULE_PAYMENT_UOS_GP_TEXT_DESCRIPTION', 'UOS Global Paycard Modul<br><br><b>!Achtung!</b> Als xt:Commerce User erhalten Sie Sonderkonditionen, Details siehe <a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=57&Itemid=75" target="_new">[Link]</a>');
  define('MODULE_PAYMENT_UOS_GP_MODUL_TEXT_TITLE', '<img src="https://www.united-online-transfer.com/images/_icon_global-paycard.gif" align="middle" > global-paycard&reg; (PrePaid Internet Konto)');
  define('MODULE_PAYMENT_UOS_GP_MODUL_TEXT_DESCRIPTION', 'UOS Global Paycard Modul');
  define('MODULE_PAYMENT_UOS_GP_STATUS_TITLE','Aktivieren dieses U O S Modules');
  define('MODULE_PAYMENT_UOS_GP_ID_TITLE','Project-ID');
  define('MODULE_PAYMENT_UOS_GP_KEY_TITLE','Security-Key');
  define('MODULE_PAYMENT_UOS_GP_CURRENCY_TITLE','W�hrung');
  define('MODULE_PAYMENT_UOS_GP_ZONE_TITLE','Steuer Zone');
  define('MODULE_PAYMENT_UOS_GP_ORDER_STATUS_ID_TITLE','Bestell Status setzen');
  define('MODULE_PAYMENT_UOS_GP_SORT_ORDER_TITLE','Anzeige Reihenfolge.');
  define('MODULE_PAYMENT_UOS_GP_STATUS_DESC','Wollen Sie U O S nutzen?');
  define('MODULE_PAYMENT_UOS_GP_ID_DESC','Die Projekt ID die Sie von U O S als Shop ID bekommen haben.');
  define('MODULE_PAYMENT_UOS_GP_KEY_DESC','Den Security-Key den Sie von U O S zur Segnierung der Daten�bertragung bekommen haben.');
  define('MODULE_PAYMENT_UOS_GP_CURRENCY_DESC','Die W�hrung die Sie bei U O S nutzen m�chten.');
  define('MODULE_PAYMENT_UOS_GP_ZONE_DESC','Wenn Sie hiereine Zone einstellen wird diese Payment nur f�r diese genutzt werden.');
  define('MODULE_PAYMENT_UOS_GP_ORDER_STATUS_ID_DESC','Angabe welcher Bestellstatus gesetz werden soll, nach Abschluss des Zahlvorgangs.');
  define('MODULE_PAYMENT_UOS_GP_SORT_ORDER_DESC','Reihenfolge der Anzeige aller Zahlsysteme. Die Kleinste zuerst.');
  
  define('MODULE_PAYMENT_UOS_GP_MODUL_ALLOWED_TITLE', 'Erlaubte Zonen');
define('MODULE_PAYMENT_UOS_GP_MODUL_ALLOWED_DESC', 'Geben Sie <b>einzeln</b> die Zonen an, welche f&uuml;r dieses Modul erlaubt sein sollen. (z.B. AT,DE (wenn leer, werden alle Zonen erlaubt))');
  

?>