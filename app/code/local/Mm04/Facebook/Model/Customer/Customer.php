<?php
/**
 * Extend Customer Model with Facebook login
 * @author: sebastian
 */
 
 class Mm04_Facebook_Model_Customer_Customer extends Mage_Customer_Model_Customer {
     protected $_fb = null;

     /**
      * @return Mm04_Facebook_Model_Graph
      */
     protected function _getFb() {
        if(is_null($this->_fb)) {
            $this->_fb = Mage::getSingleton('facebook/graph');
        }
         return $this->_fb;
     }

     /**
      * load customer by facebook id
      * @param  $facebookId
      * @return Mm04_Facebook_Model_Customer_Customer
      */
     public function loadByFacebookId($facebookId)
     {
        $this->_getResource()->loadByFacebookId($this, $facebookId);
        return $this;
     }
     
     /**
      * receive e-mail, firstname and lastname from facebook
      * @return Mm04_Facebook_Model_Customer_Customer
      */
     public function getDataFromFacebook()
     {
        $data = $this->_getFb()->getUserData();
        $this->setEmail($data['email']);
        $this->setFirstname($data['first_name']);
        $this->setLastname($data['last_name']);
        return $this;
     }

 }
 