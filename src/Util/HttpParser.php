<?php

namespace RawPHP\CommunicationLogger\Util;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Class HttpParser
 *
 * @package RawPHP\CommunicationLogger\Util
 */
class HttpParser
{

    /**
     * Format request to string.
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    public function getRequestAsString(RequestInterface $request)
    {
        return $this->getFormattedQueryParameters($request) .
        PHP_EOL .
        $this->getBodyWithHeaders($request);
    }

    /**
     * Format query parameters.
     *
     * @param RequestInterface $request
     *
     * @return string
     */
    public function getFormattedQueryParameters(RequestInterface $request)
    {
        return $this->getString($this->getQueryParameters($request->getUri()->getQuery()));
    }

    /**
     * Get body with headers.
     *
     * @param MessageInterface $stream
     *
     * @return string
     */
    public function getBodyWithHeaders(MessageInterface $stream)
    {
        $result = sprintf(
            '%s%s%s',
            $this->getString($stream->getHeaders()),
            PHP_EOL,
            $stream->getBody()->getContents()
        );

        return $result;
    }

    /**
     * Get query parameters.
     *
     * @param string $query
     *
     * @return array
     */
    protected function getQueryParameters($query)
    {
        $pairs = explode('&', $query);

        $parameters = [];

        foreach ($pairs as $pair) {
            if ('' === trim($pair)) {
                continue;
            }

            $nameValue = explode('=', $pair);

            $name = urlencode($nameValue[0]);
            $value = urlencode($nameValue[1]);

            $parameters[$name] = $value;
        }

        return $parameters;
    }

    /**
     * Implode array to string.
     *
     * @param array $array
     *
     * @return string
     */
    protected function getString(array $array)
    {
        return $this->implodeAssociative(': ', $array);
    }

    /**
     * Implode associative array into string.
     *
     * @param string $glue
     * @param array $array
     *
     * @return string
     */
    protected function implodeAssociative($glue, array $array)
    {
        $result = '';

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = implode('|', $value);
            }

            $result .= $key . $glue . $value . PHP_EOL;
        }

        return $result;
    }
}
