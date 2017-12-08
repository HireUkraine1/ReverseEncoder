<?php

namespace HireUkraine\ReversibleEncryption;

use Illuminate\Support\ServiceProvider;

class ReverseEncoderProvider extends ServiceProvider
{
    /**
     * Register Reverse Encoder service.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ReverseEncoder::class, function () {
            return new ReverseEncoder;
        });
    }
}
