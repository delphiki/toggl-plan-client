<?php

namespace Delphiki\TogglPlan\Client;

use Delphiki\TogglPlan\Client\Trait\GroupsTrait;
use Delphiki\TogglPlan\Client\Trait\MembersTrait;
use Delphiki\TogglPlan\Client\Trait\MilestonesTrait;
use Delphiki\TogglPlan\Client\Trait\ProjectsTrait;
use Delphiki\TogglPlan\Client\Trait\TasksTrait;
use Delphiki\TogglPlan\Client\Trait\UserProfileTrait;
use Delphiki\TogglPlan\Exception\TogglPlanClientException;
use GuzzleHttp\Client;

class TogglPlanClient
{
    use UserProfileTrait;
    use MembersTrait;
    use TasksTrait;
    use MilestonesTrait;
    use ProjectsTrait;
    use GroupsTrait;

    private string $accessToken;
    private Client $client;

    public function __construct(
        private string $user,
        private string $password,
        private string $clientId,
        private string $clientSecret,
        private string $baseUri = 'https://api.plan.toggl.com/api/v5/',
    )
    {
        $this->client = new Client(['base_uri' => $this->baseUri]);

        $this->login();
    }

    private function login(): void
    {
        $response = $this->client->request('POST', 'authenticate/token', [
            'form_params' => [
                'grant_type' => 'password',
                'username' => $this->user,
                'password' => $this->password,
            ],
            'headers' => [
                'Authorization' => 'Basic '.base64_encode("$this->clientId:$this->clientSecret"),
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            return;
        }

        $responseData = json_decode($response->getBody()->getContents(), true);

        $this->accessToken = $responseData['access_token'];
    }

    protected function request(string $method, string $endpoint, ?array $parameters = null): array
    {
        $requestParameters = [
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ]
        ];

        if ($parameters && count($parameters) > 0) {
            $requestParameters['json'] = $parameters;
        }

        $response = $this->client->request($method, $endpoint, $requestParameters);

        switch ($response->getStatusCode()) {
            case 403:
                throw new TogglPlanClientException('Not allowed to perform this request, check your credentials.');
            case 404:
                throw new TogglPlanClientException('Toggl Plan endpoint not found.');
        }

        if ($response->getStatusCode() !== 200) {
            return [];
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    protected function get(string $endpoint): array
    {
        return $this->request('GET', $endpoint);
    }

    protected function put(string $endpoint, array $parameters): array
    {
        return $this->request('PUT', $endpoint, $parameters);
    }

    protected function post(string $endpoint, array $parameters): array
    {
        return $this->request('POST', $endpoint, $parameters);
    }

    protected function delete(string $endpoint): array
    {
        return $this->request('DELETE', $endpoint);
    }
}