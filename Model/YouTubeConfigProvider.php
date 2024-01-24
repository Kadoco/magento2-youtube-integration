<?php
declare(strict_types=1);

namespace Kadoco\YouTube\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use phpDocumentor\Reflection\Types\String_;

class YouTubeConfigProvider
{
    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;
    /**
     * @var ScopeConfigInterface
     */
    private ScopeConfigInterface $scopeConfig;

    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    public function getIsActive():string
    {
        return (string) $this->getConfigValue('youtube/configuration/active');
    }

    public function getApi():string
    {
        return (string) $this->getConfigValue('youtube/configuration/api');
    }

    public function getChannelId():string
    {
        return (string) $this->getConfigValue('youtube/configuration/channelid');
    }

    public function getYouTubeUrl(): String
    {
        return (string) $this->getConfigValue('youtube/configuration/url');
    }

    public function getMediaUrl():string
    {
        return "https://www.googleapis.com/youtube/v3/search";
    }

    public function getMediaFields()
    {
        return "id,media_url,caption,media_type,thumbnail_url,timestamp,permalink,username";
    }

    private function getConfigValue(string $path): string
    {
        $storeId = $this->storeManager->getStore()->getId();

        return (string) $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
