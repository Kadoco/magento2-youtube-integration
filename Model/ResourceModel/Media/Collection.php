<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Model\ResourceModel\Media;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Kadoco\YouTube\Model\Media;
use Kadoco\YouTube\Model\ResourceModel\Media as MediaResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Media::class, MediaResourceModel::class);
    }
}
