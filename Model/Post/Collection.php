<?php

namespace Ivey\Tumblr\Model\Post;

class Collection extends \Magento\Framework\Data\Collection
{
    /**
     * Item object class name
     *
     * @var string
     */
    protected $_itemObjectClass = 'Ivey\Tumblr\Model\TextPost';

    protected $apiClient;

    /**
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory
     * @param \Ivey\Tumblr\Model\Api\Client $client
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Ivey\Tumblr\Model\Api\Client $client
    ) {
        $this->apiClient = $client;
        parent::__construct($entityFactory);
    }

    /**
     * Load data
     *
     * @param bool $printQuery
     * @param bool $logQuery
     * @return Collection
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function loadData($printQuery = false, $logQuery = false)
    {
        if (!$this->isLoaded()) {
            $posts = $this->apiClient->getLatestPosts();
            foreach ($posts as $postData) {
                $textPostWrapper = $this->getNewEmptyItem();
                $textPostWrapper->addData($postData);
                $this->_addItem($textPostWrapper);
            }
            $this->_setIsLoaded(true);
        }
        return $this;
    }
}