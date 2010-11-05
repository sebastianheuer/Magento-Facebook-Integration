<?php
/**
 * 
 * @author: sebastian
 */

 class Mm04_Facebook_Block_Init extends Mage_Core_Block_Template {

     /**
      * get Facebook session
      * @return Array
      */
     public function getFacebookSession() {
         /** @var $_graph Mm04_Facebook_Model_Graph */
         $_graph = Mage::getSingleton('facebook/graph');
         return $_graph->getSession();
     }

     /**
      * get Magento login url
      * @return string
      */
     public function getFacebookLoginurl() {
         return Mage::getUrl('customer/account/loginWithFacebook');
     }
 }
 