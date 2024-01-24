<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $page->setActiveMenu('Kadoco_YouTube::youtube');
        $page->getConfig()->getTitle()->prepend(__('YouTube media'));

        return $page;
    }
}
