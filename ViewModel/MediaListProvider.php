<?php
declare(strict_types=1);

namespace Kadoco\YouTube\ViewModel;

use Kadoco\YouTube\Model\Media;
use Kadoco\YouTube\Model\ResourceModel\Media\CollectionFactory;

class MediaListProvider
{
    private CollectionFactory $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param int $size
     * @return Media[]
     */
    public function execute(int $size): array
    {
        /** @var \Kadoco\YouTube\Model\ResourceModel\Media\Collection $collection */
        $collection = $this->collectionFactory->create();
        $items = $collection->setOrder('publishedAt', 'DESC')
            ->setPageSize($size)
            ->setCurPage(1)
            ->getItems();

        return $items;
    }
}
