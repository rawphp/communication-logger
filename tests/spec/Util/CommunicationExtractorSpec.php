<?php

namespace spec\RawPHP\CommunicationLogger\Util;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use RawPHP\CommunicationLogger\Util\CommunicationExtractor;
use PhpSpec\ObjectBehavior;
use RawPHP\CommunicationLogger\Util\HttpParser;

class CommunicationExtractorSpec extends ObjectBehavior
{
    function let(HttpParser $parser)
    {
        $this->beConstructedWith($parser);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CommunicationExtractor::class);
    }

    function it_returns_a_formatted_request(RequestInterface $request, Uri $uri, HttpParser $parser)
    {
        $request->getUri()->shouldBeCalled()->willReturn($uri);
        $request->getMethod()->shouldBeCalled()->willReturn('POST');

        $parser->getRequestAsString($request)->shouldBeCalled()->willReturn(
            'POST http://example.com HTTP/' . PHP_EOL . '{"data": {}}'
        );

        $uri->__toString()->shouldBeCalled()->willReturn('http://example.com');

        $this->getRequest($request)->shouldReturn(
            [
                'request' => 'POST http://example.com HTTP/' . PHP_EOL . '{"data": {}}',
                'endpoint' => 'http://example.com',
                'method' => 'POST',
            ]
        );
    }

    function it_returns_a_formatted_response(MessageInterface $response, HttpParser $parser)
    {
        $parser->getBodyWithHeaders($response)->shouldBeCalled()->willReturn('{"data": {}}');

        $this->getResponse($response)->shouldReturn(
            [
                'response' => '{"data": {}}',
            ]
        );
    }
}
