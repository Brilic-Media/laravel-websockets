<?php

namespace Longriders\LaravelWebSockets\Server\Messages;

use Longriders\LaravelWebSockets\Contracts\ChannelManager;
use Longriders\LaravelWebSockets\Contracts\PusherMessage;
use Illuminate\Support\Str;
use Ratchet\ConnectionInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class PusherMessageFactory
{
    /**
     * Create a new message.
     *
     * @param  \Ratchet\RFC6455\Messaging\MessageInterface  $message
     * @param  \Ratchet\ConnectionInterface  $connection
     * @param  \Longriders\LaravelWebSockets\Contracts\ChannelManager  $channelManager
     * @return PusherMessage
     */
    public static function createForMessage(
        MessageInterface $message,
        ConnectionInterface $connection,
        ChannelManager $channelManager): PusherMessage
    {
        $payload = json_decode($message->getPayload());

        return Str::startsWith($payload->event, 'pusher:')
            ? new PusherChannelProtocolMessage($payload, $connection, $channelManager)
            : new PusherClientMessage($payload, $connection, $channelManager);
    }
}
