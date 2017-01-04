<?php

namespace Ivey\Tumblr\Model\Api;

use Ivey\Tumblr\Helper\Data;

class Client
{
    /** @var GatewayFactory */
    protected $getawayFactory;

    /** @var Data */
    protected $_config;

    function __construct(GatewayFactory $getawayFactory, Data $config)
    {
        $this->getawayFactory = $getawayFactory;
        $this->_config = $config;
    }

    /**
     * Returns latest blog posts
     * @return array
     */
    public function getLatestPosts()
    {
        /** @var \stdClass $blogResponse */
        $blogResponse = $this->getawayFactory->create()
            ->getBlogPosts($this->_config->getBlogName(), [
                'limit' => $this->_config->getPostLimit()
            ]);

        if ($blogResponse->total_posts > 0) {
            // Do convert from stdClass object into key => value array
            $blogsData = json_decode(json_encode($blogResponse->posts), true);
            return $this->prepareBlogData($blogsData);
        }
        return [];
    }

    protected function prepareBlogData($blogsData)
    {
        return array_map(function($data) {
            preg_match('/(.*)<\!-- more/sU', $data['body'], $description);

            if (count($description) > 1) {
                $data['body'] = preg_replace_callback(
                    '/<p><img.+><\/p>/sU',
                    function ($image) use (&$data) {
                        preg_match('/src="(.+)"/sU', $image[0], $imageUrl);
                        $data['image_url'] =  $imageUrl[1];
                    },
                    $description[1]
                );
            }

            return $data;
        }, $blogsData);
    }
}