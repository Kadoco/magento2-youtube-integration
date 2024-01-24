<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Model\ResourceModel;

class Media extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('youtube_media', 'id');
        $this->_isPkAutoIncrement = false;
    }


}
