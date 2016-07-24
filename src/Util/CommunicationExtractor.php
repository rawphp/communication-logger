<?php

namespace RawPHP\CommunicationLogger\Util;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class CommunicationExtractor
 *
 * @package RawPHP\CommunicationLogger\Util
 */
class CommunicationExtractor
{
    /** @var  HttpParser */
    protected $parser;

    /**
     * CommunicationsExtractor constructor.
     *
     * @param HttpParser $parser
     */
    public function __construct(HttpParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Format request.
     *
     * @param RequestInterface $request
     *
     * @return array
     */
    public function getRequest(RequestInterface $request)
    {
        $requestStr = $this->parser->getRequestAsString($request);
        $endpoint = (string)$request->getUri();
        $method = $request->getMethod();

        return [
            'request' => $requestStr,
            'endpoint' => $endpoint,
            'method' => $method,
        ];
    }

    /**
     * Format response.
     *
     * @param MessageInterface $response
     *
     * @return array
     */
    public function getResponse(MessageInterface $response)
    {
        $result = [];

        if (null !== $response) {
            $responseStr = $this->parser->getBodyWithHeaders($response);

            $result = ['response' => $responseStr];
        }

        return $result;
    }
}
