<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts;

interface ApiParamsInterface
{
    public function getEndPoint(): string;

    public function getKey(): string;

    public function getSecret(): string;

    public function getPassphrase(): string;
}
