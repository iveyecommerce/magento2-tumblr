<?php

namespace Ivey\Tumblr\Model\Api;

use Ivey\Tumblr\Helper\Data;
use Magento\Framework\ObjectManagerInterface;

class GatewayFactory
{
    /**
     * @var ObjectManagerInterface
     */
    private $_objectManager;

    /**
     * @var Data
     */
    private $_config;

    /**
     * @param ObjectManagerInterface $objectManager
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        Data $config
    ) {
        $this->_objectManager = $objectManager;
        $this->_config = $config;
    }

    /**
     * Create gateway
     * @return \Tumblr\API\Client
     */
    public function create()
    {
        return $this->_objectManager->create(\Tumblr\API\Client::class, [
            'consumerKey' => $this->_config->getConsumerKey(),
            'consumerSecret' => $this->_config->getConsumerSecret(),
        ]);
    }
}