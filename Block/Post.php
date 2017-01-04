<?php

namespace Ivey\Tumblr\Block;

use Magento\Framework\View\Element\Template;
use Ivey\Tumblr\Model\Post\Collection;

class Post extends Template
{
    protected $textPosts;

    public function __construct(
        Template\Context $context,
        array $data = [],
        Collection $collection
    ) {
        $this->textPosts = $collection;
        parent::__construct($context, $data);
    }

    public function getPostsList()
    {
        return $this->textPosts->getItems();
    }
}