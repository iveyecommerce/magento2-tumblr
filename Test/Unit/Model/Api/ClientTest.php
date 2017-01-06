<?php

namespace Ivey\Tumblr\Test\Unit\Model\Api;

use Ivey\Tumblr\Model\Api\GatewayFactory;
use Ivey\Tumblr\Helper\Data;
use Ivey\Tumblr\Model\Api\Client;
use Tumblr\API\Client as TumblrClient;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /** @var Client */
    protected $client;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $mockTumblrApiClient;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $mockHelperData;

    public function setUp()
    {
        $objectManger = new ObjectManager($this);
        $this->mockTumblrApiClient = $this->getMockBuilder(TumblrClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockHelperData = $this->getMockBuilder(Data::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockGatewayFactory = $this->getMockBuilder(GatewayFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockGatewayFactory->method('create')
            ->willReturn($this->mockTumblrApiClient);

        $this->client = $objectManger->getObject(Client::class, [
            'getawayFactory' => $mockGatewayFactory,
            'config' => $this->mockHelperData
        ]);
    }

    public function tearDown()
    {
        $this->client = null;
        $this->mockTumblrApiClient = null;
    }

    /**
     * @dataProvider latestPostsDataProvider
     */
    public function testGetLatestPosts(
        $blogName,
        $postsLimit,
        $mockResponseObject,
        $expectedResult
    ) {
        $this->mockTumblrApiClient->expects($this->once())
            ->method('getBlogPosts')
            ->with($blogName, [
                'limit' => $postsLimit
            ])->willReturn($mockResponseObject);

        $this->mockHelperData
            ->method('getBlogName')
            ->willReturn($blogName);

        $this->mockHelperData
            ->method('getPostLimit')
            ->willReturn($postsLimit);

        $this->assertEquals($expectedResult, $this->client->getLatestPosts());
    }

    public function latestPostsDataProvider()
    {
        $mockPostData = new \stdClass();
        $mockPostData->body = '';

        $mockResponseObject1 = new \stdClass();
        $mockResponseObject1->total_posts = 0;
        $mockResponseObject1->posts = [];

        $mockResponseObject2 = new \stdClass();
        $mockResponseObject2->total_posts = 2;
        $mockResponseObject2->posts = [$mockPostData,$mockPostData];

        return [
            [
                'blog_name',
                10,
                $mockResponseObject1,
                []
            ],
            [
                'blog_name',
                10,
                $mockResponseObject2,
                [
                    ['body' => ''],
                    ['body' => '']
                ]
            ]
        ];
    }
}