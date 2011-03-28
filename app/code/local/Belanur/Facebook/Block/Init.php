<?php
/**
 *
 * @author: Sebastian Heuer <belanur@gmail.com>
 */

class Belanur_Facebook_Block_Init extends Mage_Core_Block_Template
{

    /**
     * get Facebook session
     * @return Array
     */
    public function getFacebookSession()
    {
        /** @var $_graph Belanur_Facebook_Model_Graph */
        $_graph = Mage::getSingleton('facebook/graph');
        return $_graph->getSession();
    }

    /**
     * get Magento login url
     * @return string
     */
    public function getFacebookLoginurl()
    {
        return Mage::getUrl('customer/account/loginWithFacebook');
    }
}
 