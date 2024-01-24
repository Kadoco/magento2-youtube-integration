<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Service;

use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Kadoco\YouTube\Model\YouTubeConfigProvider;

class GetMediaList
{
    private Curl $curl;
    /**
     * @var YouTubeConfigProvider
     */
    private YouTubeConfigProvider $configProvider;
    /**
     * @var Json
     */
    private Json $json;

    public function __construct(
        Curl $curl,
        YouTubeConfigProvider $configProvider,
        Json $json
    ) {
        $this->curl = $curl;
        $this->configProvider = $configProvider;
        $this->json = $json;
    }

    public function execute($page = null): array
    {
        if (!$page) {
            $query = http_build_query(
                [
                    'order' => 'date',
                    'key' => $this->configProvider->getApi(),
                    'part' => 'snippet',
                    'maxResults' => '1000',
                    'channelId' => $this->configProvider->getChannelId(),
                ]
            );
            $this->curl->get($this->configProvider->getMediaUrl() . '?' . $query);
        } else {
            $this->curl->get($page);
        }

        return $this->json->unserialize($this->curl->getBody());
    }
}
