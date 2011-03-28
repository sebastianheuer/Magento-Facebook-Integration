<?php
/**
 * Extended Customer Entity for Facebook Integration
 * @author: Sebastian Heuer <belanur@gmail.com>
 */

class Belanur_Facebook_Model_Customer_Entity_Customer extends Mage_Customer_Model_Entity_Customer
{

    /**
     * Load customer by facebook id
     *
     * @param Mage_Customer_Model_Customer $customer
     * @param string $facebookId
     * @param bool $testOnly
     * @return Mage_Customer_Model_Entity_Customer
     * @throws Mage_Core_Exception
     */
    public function loadByFacebookId(Mage_Customer_Model_Customer $customer, $facebookId, $testOnly = false)
    {
        $select = $this->_getReadAdapter()->select()->from($this->getEntityTable(), array
                                                                                    ($this->getEntityIdField()))//->where('email=?', $email);
            ->where('facebook_id=:facebook_id');
        if ($customer->getSharingConfig()->isWebsiteScope()) {
            if (!$customer->hasData('website_id')) {
                Mage::throwException(Mage::helper('customer')->__('Customer website ID must be specified when using the website scope.'));
            }
            $select->where('website_id=?', (int)$customer->getWebsiteId());
        }

        if ($id = $this->_getReadAdapter()->fetchOne($select, array('facebook_id' => $facebookId))) {
            $this->load($customer, $id);
        } else {
            $customer->setData(array());
        }
        return $this;
    }

}
 