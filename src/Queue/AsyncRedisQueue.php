<?php

namespace BrillicMedia\LaravelWebSockets\Queue;

use BrillicMedia\LaravelWebSockets\Contracts\ChannelManager;
use Illuminate\Queue\RedisQueue;

class AsyncRedisQueue extends RedisQueue
{
    /**
     * Get the connection for the queue.
     *
     * @return \BrillicMedia\LaravelWebSockets\Contracts\ChannelManager|\Illuminate\Redis\Connections\Connection
     */
    public function getConnection()
    {
        $channelManager = $this->container->bound(ChannelManager::class)
            ? $this->container->make(ChannelManager::class)
            : null;

        return $channelManager && method_exists($channelManager, 'getRedisClient')
            ? $channelManager->getRedisClient()
            : parent::getConnection();
    }
}
