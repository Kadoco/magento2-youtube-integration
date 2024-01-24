<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Ui\Component\Listing\Columns;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = 'thumbnail';
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$fieldName . '_src'] = $item['thumbnail'];
                $item[$fieldName . '_alt'] = $item['description'];
                $item[$fieldName . '_link'] = $item['video_url'];
                $item[$fieldName . '_orig_src'] = $item['thumbnail'];
            }
        }

        return $dataSource;
    }
}
