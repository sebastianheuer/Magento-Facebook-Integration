<?php
/**
 *
 * @author: Sebastian Heuer <belanur@gmail.com>
 */

class Belanur_Facebook_Block_Userinfo extends Mage_Core_Block_Template
{

    /**
     * get Facebook session
     * @return Array
     */
    public function getFacebookUsername()
    {
        /** @var $_graph Belanur_Facebook_Model_Graph */
        $_graph = Mage::getSingleton('facebook/graph');
        $_facebookData = $_graph->getUserData();
        $_name = $_facebookData['name'];
        return $_name;
    }

    public function getFacebookLink()
    {
        /** @var $_graph Belanur_Facebook_Model_Graph */
        $_graph = Mage::getSingleton('facebook/graph');
        $_facebookData = $_graph->getUserData();
        $_link = $_facebookData['link'];
        return $_link;
    }

    public function getFacebookPicture()
    {
        /** @var $_graph Belanur_Facebook_Model_Graph */
        $_graph = Mage::getSingleton('facebook/graph');
        $_facebookSession = $_graph->getSession();
        $_uid = $_facebookSession['uid'];
        return "http://graph.facebook.com/$_uid/picture";
    }
}
