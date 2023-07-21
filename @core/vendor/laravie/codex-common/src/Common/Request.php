<?php

namespace Laravie\Codex\Common;

use Psr\Http\Message\ResponseInterface;
use Laravie\Codex\Contracts\Client as ClientContract;
use Laravie\Codex\Contracts\Endpoint as EndpointContract;
use Laravie\Codex\Contracts\Response as ResponseContract;

abstract class Request implements \Laravie\Codex\Contracts\Request
{
    /**
     * The Codex client.
     *
     * @var \Laravie\Codex\Contracts\Client
     */
    protected $client;

    /**
     * Create Endpoint instance.
     *
     * @param  string $uri
     * @param array<int, string>|string  $path
     * @param  array<string, string>  $query
     *
     * @return \Laravie\Codex\Contracts\Endpoint
     */
    public static function to(string $uri, $path = [], array $query = []): EndpointContract
    {
        return new Endpoint($uri, $path, $query);
    }

    /**
     * Set Codex Client.
     *
     * @param  \Laravie\Codex\Contracts\Client  $client
     *
     * @return $this
     */
    final public function setClient(ClientContract $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Resolve the responder class.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $message
     *
     * @return \Laravie\Codex\Contracts\Response
     */
    abstract protected function responseWith(ResponseInterface $message): ResponseContract;
}
