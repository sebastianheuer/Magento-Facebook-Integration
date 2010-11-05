<?php

class Mm04_Facebook_Model_Observer
{
    /**
     * @param  $observer
     * @return void
     */
    public function customerSessionInit($observer) {
        $session = $observer->getCustomerSession();
        if(!$session->isLoggedIn()) {
            // no customer logged in, check facebook session
            $_graph = Mage::getSingleton('facebook/graph');
            $_facebookSession = $_graph->getSession();
            if(is_array($_facebookSession)) {
                $uid = $_facebookSession['uid'];
                $_facebookCustomer = $session->getCustomer();
                $_facebookCustomer = $_facebookCustomer->loadByFacebookId($uid);
                if($_facebookCustomer->getId()) {
                    $session->setId($_facebookCustomer->getId());
                }
            }
        }
        // check if the facebook session is still valid
        elseif ($facebookId = $session->getCustomer()->getFacebookId()) {
            $_valid = true;
            $_graph = Mage::getSingleton('facebook/graph');
            $_facebookSession = $_graph->getSession();
            if(!$_graph->getUserData()) {
                $_valid = false;
            }
            elseif(!is_array($_facebookSession)) {
                $_valid = false;
            }
            elseif($_facebookSession['uid'] != $facebookId) {
                $_valid = false;
            }
            if(!$_valid) {
                $session->setId(null);
                $session->unsetAll();
            }
        }
    }

}