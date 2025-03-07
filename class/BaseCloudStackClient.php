<?php

declare(strict_types=1);

require_once dirname(__FILE__) . "/CloudStackClientException.php";

class BaseCloudStackClient
{
    private string $endpoint;
    private string $apiKey;
    private string $secretKey;

    public function __construct(
        string $endpoint,
        string $apiKey,
        string $secretKey
    ) {
        // Validate API endpoint
        if (empty($endpoint)) {
            throw new CloudStackClientException(CloudStackError::ENDPOINT_EMPTY);
        }

        if (!str_starts_with($endpoint, "http://") && !str_starts_with($endpoint, "https://")) {
            throw new CloudStackClientException(CloudStackError::ENDPOINT_NOT_URL, sprintf("Invalid endpoint URL: %s", $endpoint));
        }

        $this->endpoint = rtrim($endpoint, '/');
        $this->apiKey = $apiKey ?: throw new CloudStackClientException(CloudStackError::APIKEY_EMPTY);
        $this->secretKey = $secretKey ?: throw new CloudStackClientException(CloudStackError::SECRETKEY_EMPTY);
    }

    private function getSignature(string $queryString): string
    {
        if (empty($queryString)) {
            throw new CloudStackClientException(CloudStackError::STRTOSIGN_EMPTY);
        }

        // Generate HMAC SHA-1 signature
        $hash = hash_hmac("sha1", strtolower($queryString), $this->secretKey, true);
        return urlencode(base64_encode($hash));
    }

    public function request(string $command, array $args = []): mixed
    {
        if (empty($command)) {
            throw new CloudStackClientException(CloudStackError::NO_COMMAND);
        }

        // Remove empty values
        $args = array_filter($args, fn($value) => $value !== "");

        $args['apikey'] = $this->apiKey;
        $args['command'] = $command;
        $args['response'] = "json";
        ksort($args);

        $query = http_build_query($args);
        $query = str_replace("+", "%20", $query); // Ensure proper encoding
        $query .= "&signature=" . $this->getSignature($query);

        $url = "$this->endpoint?$query";

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 3
        ]);

        $json = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch) || $httpCode !== 200) {
            $errorMsg = curl_error($ch) ?: "HTTP error code: $httpCode";
            $json = json_encode(['errorresponse' => ['errortext' => $errorMsg]]);
        }

        curl_close($ch);
        return json_decode($json, true);
    }
}
