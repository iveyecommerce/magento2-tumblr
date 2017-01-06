<?php

namespace Ivey\Tumblr\Test\Unit\Block;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Ivey\Tumblr\Block\Post;
use Ivey\Tumblr\Model\Post\Collection;

class PostTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Post */
    protected $block;

    public function setUp()
    {
        $objectManager = new ObjectManager($this);

        $mockPostCollection = $this->getMockBuilder(Collection::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockPostCollection->method('getItems')->willReturn([]);

        $this->block = $objectManager->getObject(Post::class, [
            'collection' => $mockPostCollection
        ]);
    }

    public function tearDown()
    {
        $this->block = null;
    }

    public function testGetPostsList()
    {
        $this->assertInternalType('array', $this->block->getPostsList());
    }
}