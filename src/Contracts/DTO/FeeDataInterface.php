<?php

/**
 * @author Marc MOREAU <moreau.marc.web@gmail.com>
 * @license https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/LICENSE.md MIT
 * @link https://github.com/MockingMagician/coinbase-pro-sdk/blob/master/README.md
 */

namespace MockingMagician\CoinbaseProSdk\Contracts\DTO;

/**
 * Class FeeDataInterface.
 */
interface FeeDataInterface
{
    public function getMakerFeeRate(): float;

    public function getTakerFeeRate(): float;

    public function getUsdVolume(): float;
}
