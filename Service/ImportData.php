<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Service;

use Kadoco\YouTube\Model\MediaFactory;
use Kadoco\YouTube\Model\Media;
use Kadoco\YouTube\Model\ResourceModel\Media as MediaResourceModel;

class ImportData
{
    /**
     * @var GetMediaList
     */
    private GetMediaList $getMediaList;
    /**
     * @var MediaFactory
     */
    private MediaFactory $mediaFactory;
    /**
     * @var MediaResourceModel
     */
    private MediaResourceModel $mediaResourceModel;

    public function __construct(
        GetMediaList $getMediaList,
        MediaFactory $mediaFactory,
        MediaResourceModel $mediaResourceModel
    ) {
        $this->getMediaList = $getMediaList;
        $this->mediaFactory = $mediaFactory;
        $this->mediaResourceModel = $mediaResourceModel;
    }

    public function execute()
    {
        $next = null;
        do {
            $medias = [];
            $result = $this->getMediaList->execute($next);
            if (isset($result['items'])) {
                foreach ($result['items'] as $media) {
                    $medias[] = $media;
                }
            }
            $this->saveMedia($medias);
            $next = (isset($result['paging']['next'])) ? $result['paging']['next'] : false;
        } while ($next);

        return $medias;
    }

    public function saveMedia($medias)
    {
        foreach ($medias as $media) {
            /** @var Media $media */
            $mediaModel = $this->mediaFactory->create();
            if (!isset($media['id']['videoId'])) {
                continue;
            }
            $data = [
                'id' => hexdec(crc32($media['id']['videoId'])),
                'video_id' => $media['id']['videoId'],
                'video_url' => 'https://www.youtube.com/watch?v=' . $media['id']['videoId'],
                'publishedAt' => $media['snippet']['publishedAt'],
                'title' => $media['snippet']['title'],
                'description' => $media['snippet']['description'],
                'thumbnail' => $media['snippet']['thumbnails']['high']['url'],
                'channelTitle' => $media['snippet']['channelTitle'],
            ];
            $mediaModel->setData($data);
            $this->mediaResourceModel->save($mediaModel);
        }
    }
}
