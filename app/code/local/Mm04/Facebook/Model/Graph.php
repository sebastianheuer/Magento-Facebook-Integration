<?php

require_once('facebook.php');

class Mm04_Facebook_Model_Graph
{
    /** @var $_fb Facebook */
	protected $_fb = null;

    /**
     * @return Facebook
     */
	protected function _getFb()
	{
		if(is_null($this->_fb))
		{
            $_appId = Mage::getStoreConfig('facebook/graph_api/application_id');
            $_appSecret = Mage::getStoreConfig('facebook/graph_api/application_secret');
			if($_appId && $_appSecret) {
                $this->_fb = new Facebook(array(
                   'appId' => $_appId,
                   'secret' => $_appSecret,
                   'status' => true,
                   'cookie' => true,
                ));
            }
		}
		return $this->_fb;
	}

    /**
     * query Facebook for user data
     * @return array
     */
    public function getUserData()
    {
        try {
            $this->_getFb()->getUser();
            $data  = $this->_getFb()->api('/me');
            return $data;
        }
        catch (exception $e) {
            return false;
        }

    }

    /**
     * get the Facebook session
     * @return Array
     */
    public function getSession() {
        $data = $this->_getFb()->getSession();
        return $data;
    }
}