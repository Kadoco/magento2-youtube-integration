<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Model;

use Magento\Framework\Model\AbstractExtensibleModel;

class Media extends AbstractExtensibleModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Media::class);
    }

    public function getImageUrl()
    {
        return (string) $this->getData('thumbnail');
    }

    public function getUrl()
    {
        return $this->getData('video_url');
    }

    public function getCaption()
    {
        return $this->getData('title');
    }
}
