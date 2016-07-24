<?php

namespace spec\RawPHP\CommunicationLogger\Util;

use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use RawPHP\CommunicationLogger\Util\HttpParser;
use PhpSpec\ObjectBehavior;

class HttpParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(HttpParser::class);
    }

    function it_returns_request_as_string(RequestInterface $request, UriInterface $uri, Stream $stream)
    {
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $request->getHeaders()->shouldBeCalled()->willReturn(['content-type' => 'application/json']);
        $request->getBody()->shouldBeCalled()->willReturn($stream);

        $stream->getContents()->shouldBeCalled()->willReturn('{"data": {}}');

        $uri->getQuery()->shouldBeCalled()->willReturn('');

        $this->getRequestAsString($request);
    }

    function it_returns_formatted_query_parameters(RequestInterface $request, UriInterface $uri)
    {
        $request->getUri()->shouldBeCalled()->willReturn($uri);

        $uri->getQuery()->shouldBeCalled()->willReturn('fname=John&lname=Smith');

        $this->getFormattedQueryParameters($request)->shouldReturn(
            'fname: John' . PHP_EOL . 'lname: Smith' . PHP_EOL
        );
    }

    function it_returns_body_with_headers(RequestInterface $request, Stream $stream)
    {
        $request->getHeaders()->shouldBeCalled()->willReturn(['content-type' => 'application/json']);
        $request->getBody()->shouldBeCalled()->willReturn($stream);

        $stream->getContents()->shouldBeCalled()->willReturn('{"data": {}}');

        $this->getBodyWithHeaders($request)->shouldReturn(
            'content-type: application/json' . PHP_EOL . PHP_EOL . '{"data": {}}'
        );
    }
}
