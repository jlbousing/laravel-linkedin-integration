<?php

namespace Jlbousing\LaravelLinkedinLearning\DTO;

class AssetSearchDTO
{
    public string $accessToken;
    public string $keyword;
    public int $page;
    public int $perPage;

    public function __construct(
        string $accessToken,
        string $keyword,
        int $page = 0,
        int $perPage = 10
    )
    {
        $this->keyword = $keyword;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->accessToken = $accessToken;
    }
}
