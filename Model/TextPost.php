<?php
namespace Ivey\Tumblr\Model;

class TextPost extends AbstractPost
{
    public function getTitle()
    {
        return $this->getData('title');
    }

    public function getBody()
    {
        return $this->getData('body');
    }

    public function getImageUrl()
    {
        return $this->getData('image_url');
    }
}