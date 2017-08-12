<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyWeChat\Tests\WeWork\Server;

use EasyWeChat\Kernel\ServiceContainer;
use EasyWeChat\Tests\TestCase;
use EasyWeChat\WeWork\Server\Guard;
use Symfony\Component\HttpFoundation\Request;

class GuardTest extends TestCase
{
    public function testValidate()
    {
        $guard = \Mockery::mock(Guard::class)->makePartial();
        $this->assertSame($guard, $guard->validate());
    }

    public function testShouldReturnRawResponse()
    {
        $app = new ServiceContainer([], [
            'request' => Request::create('/path/to/resource?echostr=foo'),
        ]);
        $guard = \Mockery::mock(Guard::class, [$app])->makePartial();
        $this->assertTrue($guard->shouldReturnRawResponse());

        $app = new ServiceContainer([], [
            'request' => Request::create('/path/to/resource?foo=bar'),
        ]);
        $guard = \Mockery::mock(Guard::class, [$app])->makePartial();
        $this->assertFalse($guard->shouldReturnRawResponse());
    }
}
