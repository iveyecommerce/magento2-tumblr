<?php
namespace Ivey\Tumblr\Model;

use Magento\Framework\DataObject;

class AbstractPost extends DataObject
{
    public function getId()
    {
        return $this->getData('id');
    }

    public function getBlogName()
    {
        return $this->getData('blog_name');
    }

    public function getDate()
    {
        return $this->getData('date');
    }

    public function getUrl()
    {
        return $this->getData('post_url');
    }

    public function getAuthor()
    {
        return $this->getData('author');
    }
}