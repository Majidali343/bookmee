<?php

namespace Laravie\Codex\Common;

use Http\Discovery\HttpClientDiscovery;
use Http\Client\Common\HttpMethodsClient;
use Http\Discovery\MessageFactoryDiscovery;

class Discovery
{
    /**
     * Cache discovered HTTP Client.
     *
     * @var \Http\Client\Common\HttpMethodsClient|null
     */
    protected static $discoveredClient;

    /**
     * Make HTTP client through Discovery.
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public static function client(): HttpMethodsClient
    {
        return static::$discoveredClient
            ?? static::$discoveredClient = static::make();
    }

    /**
     * Make a HTTP Client.
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public static function make(): HttpMethodsClient
    {
        return new HttpMethodsClient(
            HttpClientDiscovery::find(),
            MessageFactoryDiscovery::find()
        );
    }

    /**
     * Make Fresh HTTP client through Discovery.
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public static function refreshClient(): HttpMethodsClient
    {
        static::flush();

        return static::client();
    }

    /**
     * Override existing HTTP client.
     *
     * @param  \Http\Client\Common\HttpMethodsClient  $client
     *
     * @return \Http\Client\Common\HttpMethodsClient
     */
    public static function override(HttpMethodsClient $client): HttpMethodsClient
    {
        static::$discoveredClient = $client;

        return $client;
    }

    /**
     * Flush any existing HTTP Client.
     *
     * @return void
     */
    public static function flush(): void
    {
        static::$discoveredClient = null;
    }
}
