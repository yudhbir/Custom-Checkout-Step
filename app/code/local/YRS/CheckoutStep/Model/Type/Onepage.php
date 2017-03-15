<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Checkout
 * @copyright  Copyright (c) 2006-2016 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * One page checkout processing model
 */

class YRS_CheckoutStep_Model_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
     /**
     * Specify quote shipping method
     *
     * @param   string $shippingMethod
     * @return  array
     */
    public function saveShippingMethod($shippingMethod)
    {
        if (empty($shippingMethod)) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        }
        $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($shippingMethod);
        if (!$rate) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        }
        $this->getQuote()->getShippingAddress()
            ->setShippingMethod($shippingMethod);

        $this->getCheckout()
            ->setStepData('shipping_method', 'complete', true)
            ->setStepData('instructional', 'allow', true);

        return array();
    }
	public function saveInstructionalMethod($instrumentalMethod)
    {
        // if (empty($instrumentalMethod)) {
            // return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        // }
        // $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($instrumentalMethod);
        // if (!$rate) {
            // return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        // }
        // $this->getQuote()->getShippingAddress()
            // ->setShippingMethod($instrumentalMethod);

        $this->getCheckout()
            ->setStepData('instructional', 'complete', true)
            ->setStepData('payment', 'allow', true);

        return array();
    }

}