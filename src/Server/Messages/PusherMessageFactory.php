<?php

namespace BrillicMedia\LaravelWebSockets\Server\Messages;

use BrillicMedia\LaravelWebSockets\Contracts\ChannelManager;
use BrillicMedia\LaravelWebSockets\Contracts\PusherMessage;
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
     * @param  \BrillicMedia\LaravelWebSockets\Contracts\ChannelManager  $channelManager
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
