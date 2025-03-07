<?php

declare(strict_types=1);

require_once dirname(__FILE__) . "/CloudStackClientException.php";

class BaseCloudStackClient
{
    private string $apiKey;
    private string $secretKey;
    private string $endpoint; // Does not end with "/"

    public function __construct(string $endpoint, string $apiKey, string $secretKey)
    {
        // Validate API endpoint
        if (empty($endpoint)) {
            throw new CloudStackClientException(ENDPOINT_EMPTY_MSG ?? "Endpoint is empty", ENDPOINT_EMPTY ?? 1001);
        }

        if (!str_starts_with($endpoint, "http://") && !str_starts_with($endpoint, "https://")) {
            throw new CloudStackClientException(sprintf(ENDPOINT_NOT_URL_MSG ?? "Invalid endpoint URL: %s", $endpoint), ENDPOINT_NOT_URL ?? 1002);
        }

        $this->endpoint = rtrim($endpoint, '/');
        $this->apiKey = $apiKey ?: throw new CloudStackClientException(APIKEY_EMPTY_MSG ?? "API key is empty", APIKEY_EMPTY ?? 1003);
        $this->secretKey = $secretKey ?: throw new CloudStackClientException(SECRETKEY_EMPTY_MSG ?? "Secret key is empty", SECRETKEY_EMPTY ?? 1004);
    }

    private function getSignature(string $queryString): string
    {
        if (empty($queryString)) {
            throw new CloudStackClientException(STRTOSIGN_EMPTY_MSG ?? "String to sign is empty", STRTOSIGN_EMPTY ?? 1005);
        }

        $hash = hash_hmac("sha1", $queryString, $this->secretKey, true);
        return urlencode(base64_encode($hash));
    }

    public function request(string $command, array $args = []): mixed
    {
        if (empty($command)) {
            throw new CloudStackClientException(NO_COMMAND_MSG ?? "No command provided", NO_COMMAND ?? 1006);
        }

        // Remove empty values
        $args = array_filter($args, fn($value) => $value !== "");

        $args['apikey'] = $this->apiKey;
        $args['command'] = $command;
        $args['response'] = "json";
        ksort($args);

        $query = http_build_query($args);
        $query = str_replace("+", "%20", $query);
        $query .= "&signature=" . $this->getSignature(strtolower($query));

        $url = "{$this->endpoint}?{$query}";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 3
        ]);

        $json = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        if (curl_errno($ch) || $httpCode !== 200) {
            $errorMsg = curl_error($ch) ?: "HTTP error code: $httpCode";
            $json = json_encode(['errorresponse' => ['errortext' => $errorMsg]]);
        }

        curl_close($ch);
        return json_decode($json, true);
    }
}
