<?php

namespace MockingMagician\CoinbaseProSdk\Tests\Unit\Rate;


use MockingMagician\CoinbaseProSdk\Functional\Build\Rate\GlobalRateLimits;
use MockingMagician\CoinbaseProSdk\Functional\Build\Rate\RateLimits;
use PHPUnit\Framework\TestCase;

class GlobalRateLimitsTest extends TestCase
{
    private function generateGlobalRateLimits(int $publicRateLimit, int $privateRateLimit, int $globalLimit)
    {
        $publicRateLimit = new RateLimits($publicRateLimit);
        $privateRateLimit = new RateLimits($privateRateLimit);

        return new GlobalRateLimits($publicRateLimit, $privateRateLimit, $globalLimit);
    }

    public function testGlobals()
    {
        $rateLimits = $this->generateGlobalRateLimits(6, 5, 10);

        self::assertEquals(10, $rateLimits->getLimit());

        self::assertFalse($rateLimits->shouldWeWait());
        self::assertFalse($rateLimits->shouldWeWaitForPublicCallRequest());
        self::assertFalse($rateLimits->shouldWeWaitForPrivateCallRequest());

        for ($i = 0; $i < 6; $i++) {
            $rateLimits->recordPublicCallRequest();
        }

        self::assertFalse($rateLimits->shouldWeWait());
        self::assertTrue($rateLimits->shouldWeWaitForPublicCallRequest());
        self::assertFalse($rateLimits->shouldWeWaitForPrivateCallRequest());

        sleep(1);

        for ($i = 0; $i < 5; $i++) {
            $rateLimits->recordPrivateCallRequest();
        }

        self::assertFalse($rateLimits->shouldWeWait());
        self::assertFalse($rateLimits->shouldWeWaitForPublicCallRequest());
        self::assertTrue($rateLimits->shouldWeWaitForPrivateCallRequest());

        sleep(1);

        for ($i = 0; $i < 6; $i++) {
            $rateLimits->recordPublicCallRequest();
            $rateLimits->recordPrivateCallRequest();
        }

        self::assertTrue($rateLimits->shouldWeWait());
        self::assertTrue($rateLimits->shouldWeWaitForPublicCallRequest());
        self::assertTrue($rateLimits->shouldWeWaitForPrivateCallRequest());
    }
}
