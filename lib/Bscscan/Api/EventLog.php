<?php

namespace Bscscan\Api;

use Bscscan\APIConf;

/**
 * Class EventLog
 * @package Bscscan\Api
 * @author Maslakou Ihar <igormaslakoff@gmail.com>
 * @author Wespify <gh@wespify.com>
 */
class EventLog extends AbstractApi
{

    /**
     * Get Event Logs
     *
     * @param $address
     * @param $topic
     * @param int $startBlock
     * @param string $endBlock
     * @return mixed
     * @throws \Bscscan\Exception\ErrorException
     */
    public function getLogs($address, $topic, $startBlock = 0, $endBlock = APIConf::TAG_LATEST)
    {
        $params = [
            'module'    => 'logs',
            'action'    => 'getLogs',
            'fromBlock' => $startBlock,
            'toBlock'   => $endBlock,
            'address'   => $address,
            'topic0'    => $topic,
        ];

        return $this->request->exec($params);
    }
}