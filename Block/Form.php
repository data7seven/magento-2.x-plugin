<?php

namespace BlueMedia\BluePayment\Block;

use BlueMedia\BluePayment\Model\ResourceModel\Gateways\CollectionFactory;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Form
 * @package BlueMedia\BluePayment\Block
 */
class Form extends \Magento\Payment\Block\Form
{
    /**
     * @var string
     */
    protected $_template = 'BlueMedia_BluePayment::bluepayment/form.phtml';

    /**
     * @var array
     */
    protected $_gatewayList = [];

    /**
     * @var \BlueMedia\BluePayment\Model\ResourceModel\Gateways\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Form constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context                      $context
     * @param \BlueMedia\BluePayment\Model\ResourceModel\Gateways\CollectionFactory $collectionFactory
     * @param array                                                                 $data
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function getGatewaysList()
    {
        if (!$this->_gatewayList) {
            $this->_gatewayList = $this->collectionFactory->create();
            $this->_gatewayList->addFieldToFilter('gateway_status', 1)->load();
        }

        return $this->_gatewayList;
    }

    /**
     * Zwraca adres do logo firmy
     *
     * @return string|bool
     */
    public function getLogoSrc()
    {
        $logo_src = $this->getViewFileUrl('BlueMedia_BluePayment::bluepayment/logo.png');

        return $logo_src != '' ? $logo_src : false;
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getMethodTitle()
    {
        return __('Quick online payment');
    }
}
