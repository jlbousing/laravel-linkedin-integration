<?php

namespace Jlbousing\LaravelLinkedinLearning\Services;

use Illuminate\Support\Facades\Http;
use Jlbousing\LaravelLinkedinLearning\Clients\LinkedinHttpClient;
use Jlbousing\LaravelLinkedinLearning\DTO\CatalogSearchDTO;
use Jlbousing\LaravelLinkedinLearning\DTO\AssetSearchDTO;
use Jlbousing\LaravelLinkedinLearning\DTO\AssetDetailDTO;

class LinkedinLearningService
{
    protected $clientId;
    protected $clientSecret;
    protected $apiUrl;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->clientId = env("LINKEDIN_LEARNING_CLIENT_ID");
        $this->clientSecret = env("LINKEDIN_LEARNING_CLIENT_SECRET");
        $this->apiUrl = env("LINKEDIN_LEARNING_API_URL");

        if (!$this->apiUrl) {
            throw new \Exception("Linkedin Learning API Url cannot be empty");
        }

        if (!$this->clientId || !$this->clientSecret) {
            throw new \Exception("Invalid Linkedin Learning API keys");
        }
    }

    protected function getClient(string $accessToken): LinkedinHttpClient
    {
        if (!$accessToken) {
            throw new \Exception("User LinkedIn access token not found.");
        }

        return new LinkedinHttpClient($accessToken);
    }

    public function getAccessToken()
    {
        try {
            $payload = [
                "grant_type" => "client_credentials",
                "client_id" => $this->clientId,
                "client_secret" => $this->clientSecret
            ];

            return Http::asForm()->post("{$this->apiUrl}/accessToken", $payload);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAllCatalog(CatalogSearchDTO $catalogSearchDTO)
    {
        try {
            $client = $this->getClient($catalogSearchDTO->accessToken);

            return $client->get("https://api.linkedin.com/v2/learningAssets", [
                "q" => "localeAndType",
                "assetType" => $catalogSearchDTO->assetType,
                "sourceLocale.language" => $catalogSearchDTO->language,
                "sourceLocale.country" => $catalogSearchDTO->country,
                "start" => $catalogSearchDTO->page,
                "count" => $catalogSearchDTO->perPage,
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function searchAssetInCatalogo(AssetSearchDTO $assetSearchDTO)
    {
        try {
            $client = $this->getClient($assetSearchDTO->accessToken);

            return $client->get("https://api.linkedin.com/v2/learningAssets", [
                "q" => "criteria",
                "assetFilteringCriteria.keyword" => $assetSearchDTO->keyword,
                "start" => $assetSearchDTO->page,
                "count" => $assetSearchDTO->perPage,
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAssetDetail(AssetDetailDTO $assetDetailDTO)
    {
        try {
            $client = $this->getClient($assetDetailDTO->accessToken);

            return $client->get("https://api.linkedin.com/v2/learningAssets/{$assetDetailDTO->urn}");
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}
