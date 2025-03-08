<?php

namespace Jlbousing\LaravelLinkedinLearning\DTO;

class CatalogSearchDTO
{
    public string $accessToken;

    public string $assetType;
    public string $language;
    public string $country;
    public int $page;
    public int $perPage;

    public function __construct(
        string $accessToken,
        string $assetType,
        string $language,
        string $country,
        int $page = 0,
        int $perPage = 10
    )
    {
        $this->assetType = $assetType;
        $this->language = $language;
        $this->country = $country;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->accessToken = $accessToken;
    }
}
