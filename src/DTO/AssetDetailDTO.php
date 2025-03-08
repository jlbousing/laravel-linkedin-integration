<?php

namespace Jlbousing\LaravelLinkedinLearning\DTO;

class AssetDetailDTO
{
    public string $accessToken;
    public string $urn;

    public function __construct(string $accessToken, string $urn)
    {
        $this->urn = $urn;
        $this->accessToken = $accessToken;
    }
}
