<?php

/* -----------------------------------------------------------------------------------------
   $Id: amoneybookers.php 192 2007-02-24 16:24:52Z mzanier $

   xt:Commerce - community made shopping
   http://www.xt-commerce.com

   Copyright (c) 2006 xt:Commerce
   -----------------------------------------------------------------------------------------
   based on:
   (c) 2000-2001 The Exchange Project  (earlier name of osCommerce)
   (c) 2002-2003 osCommerce(moneybookers.php,v 1.01 2003/01/20); www.oscommerce.com

   Released under the GNU General Public License
   -----------------------------------------------------------------------------------------
   Third Party contributions:
   Moneybookers v1.0                       Autor:    Gabor Mate  <gabor(at)jamaga.hu>

   Released under the GNU General Public License
   ---------------------------------------------------------------------------------------*/

define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_TITLE', 'Sicher bezahlen &uuml;ber Moneybookers');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_DESCRIPTION', 'Moneybookers<br /><br /><img src="images/icon_arrow_right.gif"> <b><a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=76&lang=de" target="_blank">Hilfe zu Einstellungen</a></b>');
define('MODULE_PAYMENT_AMONEYBOOKERS_NOCURRENCY_ERROR', 'Es ist keine von Moneybookers akzeptierte W&auml;hrung installiert!');
define('MODULE_PAYMENT_AMONEYBOOKERS_ERRORTEXT1', 'payment_error=');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO', '');
define('MODULE_PAYMENT_AMONEYBOOKERS_ERRORTEXT2', '&error=Fehler w&auml;hrend Ihrer Bezahlung bei Moneybookers!');
define('MODULE_PAYMENT_AMONEYBOOKERS_ORDER_TEXT', 'Bestelldatum: ');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_ERROR', 'Fehler bei Zahlung!');
define('MODULE_PAYMENT_AMONEYBOOKERS_CONFIRMATION_TEXT', 'Danke f�r Ihre Bestellung!');
define('MODULE_PAYMENT_AMONEYBOOKERS_TRANSACTION_FAILED_TEXT', 'Ihre Zahlungstransaktion bei moneybookers.com ist fehlgeschlagen. Bitte versuchen Sie es nochmal, oder w&auml;hlen Sie eine andere Zahlungsm&ouml;glichkeit!');


define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_2', '<b>100%-ige Sicherheit</b> - Ihre Daten werden  nach h&ouml;chstem Sicherheitsstandard verschl&uuml;sselt.');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_3', '<b>100%-iger Datenschutz</b> - Ihre  pers&ouml;nlichen  Daten  verbleiben bei Moneybookers als lizensiertem Finanzinstitut und werden nicht an den Shop weitergegeben.');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_4', '<b>maximaler Komfort</b> -  Nachdem Sie einmalig bei Moneybookers registriert sind, reichen Ihre E-Mail-Adresse und Passwort f&uuml;r alle k&uuml;nftigen Zahlungen.');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_5', '<b>hohe Akzeptanz</b> -  Mit Moneybookers k&ouml;nnen Sie in mehreren tausend Shops einkaufen.');
define('MODULE_PAYMENT_AMONEYBOOKERS_TEXT_INFO_1', '<br /><br />Direkt und bequem zahlen mit...');

define('MB_TEXT_MBDATE', 'Letzte Aktualisierung:');
define('MB_TEXT_MBTID', 'TR ID:');
define('MB_TEXT_MBERRTXT', 'Status:');

define('MODULE_PAYMENT_AMONEYBOOKERS_PROCESSED_STATUS_ID_TITLE', 'Bestellstatus - Processed');
define('MODULE_PAYMENT_AMONEYBOOKERS_PROCESSED_STATUS_ID_DESC', '');

define('MODULE_PAYMENT_AMONEYBOOKERS_PENDING_STATUS_ID_TITLE', 'Bestellstatus - Sheduled');
define('MODULE_PAYMENT_AMONEYBOOKERS_PENDING_STATUS_ID_DESC', '');

define('MODULE_PAYMENT_AMONEYBOOKERS_CANCELED_STATUS_ID_TITLE', 'Bestellstatus - Canceled');
define('MODULE_PAYMENT_AMONEYBOOKERS_CANCELED_STATUS_ID_DESC', '');

define('MODULE_PAYMENT_AMONEYBOOKERS_ICONS_TITLE', 'Icons');
define('MODULE_PAYMENT_AMONEYBOOKERS_ICONS_DESC', '');


define('MODULE_PAYMENT_AMONEYBOOKERS_STATUS_TITLE', 'Moneybookers aktivieren');
define('MODULE_PAYMENT_AMONEYBOOKERS_STATUS_DESC', 'M&ouml;chten Sie Zahlungen per Moneybookers akzeptieren?<br /><br /><img src="images/icon_arrow_right.gif"> <b><a href="http://www.xt-commerce.com/index.php?option=com_content&task=view&id=76&lang=de" target="_blank">Hilfe zu Einstellungen</a></b>');
define('MODULE_PAYMENT_AMONEYBOOKERS_EMAILID_TITLE', 'Moneybookers eMail Adresse');
define('MODULE_PAYMENT_AMONEYBOOKERS_EMAILID_DESC', 'eMail Adresse, die bei Moneybookers registriert ist. <br /><font color="ff0000">* Erforderlich</font>');
define('MODULE_PAYMENT_AMONEYBOOKERS_PWD_TITLE', 'Moneybookers Geheimwort');
define('MODULE_PAYMENT_AMONEYBOOKERS_PWD_DESC', 'Geben Sie Ihr Moneybookers Geheimwort ein (dies ist nicht ihr Passwort!)');
define('MODULE_PAYMENT_AMONEYBOOKERS_MERCHANTID_TITLE', 'Kunden ID ');
define('MODULE_PAYMENT_AMONEYBOOKERS_MERCHANTID_DESC', 'Ihre pers&ouml;nliche Kunden ID bei Moneybookers <br /><font color="ff0000">* Erforderlich</font>');
define('MODULE_PAYMENT_AMONEYBOOKERS_CURRENCY_TITLE', 'Transaktionsw�hrung');
define('MODULE_PAYMENT_AMONEYBOOKERS_CURRENCY_DESC', 'Die W&auml;hrung, in der der Zahlungsvorgang abgewickelt wird. Wenn Ihre gew�hlte W�hrung nicht bei Moneybookers verf�gbar ist, wird diese W�hrung ausgew�hlt.');
define('MODULE_PAYMENT_AMONEYBOOKERS_LANGUAGE_TITLE', 'Transaktionssprache');
define('MODULE_PAYMENT_AMONEYBOOKERS_LANGUAGE_DESC', 'Die Sprache, in der der Zahlungsvorgang abgewickelt wird. Wenn Ihre gew�hlte Shopsprache nicht bei Moneybookers verf�gbar ist, wird diese Sprache ausgew�hlt.');

define('MODULE_PAYMENT_AMONEYBOOKERS_COST_TITLE',_MODULES_PAYMENT_FEE_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_COST_DESC',_MODULES_PAYMENT_FEE_DESC);
define('MODULE_PAYMENT_AMONEYBOOKERS_ZONE_TITLE', _MODULES_ZONE_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_ZONE_DESC', _MODULES_ZONE_DESC);
define('MODULE_PAYMENT_AMONEYBOOKERS_ALLOWED_TITLE' , _MODULES_ZONE_ALLOWED_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_ALLOWED_DESC' ,_MODULES_ZONE_ALLOWED_DESC);
define('MODULE_PAYMENT_AMONEYBOOKERS_SORT_ORDER_TITLE', _MODULES_SORT_ORDER_TITLE);
define('MODULE_PAYMENT_AMONEYBOOKERS_SORT_ORDER_DESC', _MODULES_SORT_ORDER_DESC);
?>