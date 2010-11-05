<?php
require_once('app/code/core/Mage/Customer/controllers/AccountController.php');

/**
 * provides additional action for Facebook single sign-on
 * @author sebastian heuer
 */
class Mm04_Facebook_Customer_AccountController extends Mage_Customer_AccountController
{
    /**
     * Login a customer by his facebook id, create a new account if needed
     * @todo validate facebook id against current facebook session
     * @return void
     */
    public function loginWithFacebookAction()
    {
        $facebookId = $this->getRequest()->getParam('id');
        if(!$facebookId) {
            $this->_redirect('/');
        }

        /** @var $customer Mm04_Facebook_Model_Customer_Customer */
        $customer = $this->_getSession()->getCustomer();
        $customer->setWebsiteId(Mage::app()->getStore()->getWebsiteId());
        $customer->loadByFacebookId($facebookId);

        if($customer->getId() && $this->_isValidFacebookSession($facebookId)) {
            $this->_getSession()->setCustomerAsLoggedIn($customer);
        }
        else {
            try {
                // get user info from facebook
                $customer->setFacebookId($facebookId);
                $customer->getDataFromFacebook();

                $customer->save();
                $this->_getSession()->addNotice(Mage::helper('customer')->__('Since this is your first login, we have created a new account for you. Enjoy!'));
                $this->_getSession()->setCustomerAsLoggedIn($customer);
            }
            catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('customer/account');
    }

    /**
     * make sure the given user id matches the data from the facebook session
     * @param  $uid
     * @return bool
     */
    protected function _isValidFacebookSession($uid)
    {
        $_graph = Mage::getSingleton('facebook/graph');
        $_facebookSession = $_graph->getSession();
        if(is_array($_facebookSession)) {
            return $uid == $_facebookSession['uid'];
        }
        return false; 
    }
}
