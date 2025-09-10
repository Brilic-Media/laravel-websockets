<?php

namespace Longriders\LaravelWebSockets\Contracts;

interface PusherMessage
{
    /**
     * Respond to the message construction.
     *
     * @return void
     */
    public function respond();
}
