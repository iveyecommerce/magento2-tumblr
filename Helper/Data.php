<?php

namespace Ivey\Tumblr\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    public function getConsumerKey()
    {
        return $this->scopeConfig->getValue('flickr/general/consumerkey', ScopeInterface::SCOPE_STORE);
    }

    public function getConsumerSecret()
    {
        return $this->scopeConfig->getValue('flickr/general/consumersecret', ScopeInterface::SCOPE_STORE);
    }

    public function getBlogName()
    {
        return $this->scopeConfig->getValue('flickr/general/blogname', ScopeInterface::SCOPE_STORE);
    }

    public function getPostLimit()
    {
        return $this->scopeConfig->getValue('flickr/general/postlimit', ScopeInterface::SCOPE_STORE);
    }
}