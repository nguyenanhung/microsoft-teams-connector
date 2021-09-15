<?php
/**
 * Project microsoft-teams-connector
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/03/2020
 * Time: 23:25
 */

namespace nguyenanhung\Microsoft\Teams;

use Exception;
use Sebbmyr\Teams\TeamsConnector;
use Sebbmyr\Teams\Cards\SimpleCard;
use Sebbmyr\Teams\TeamsConnectorInterface;

/**
 * Class MicrosoftTeamsConnector
 *
 * @package   nguyenanhung\Microsoft\Teams
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MicrosoftTeamsConnector
{
    const VERSION = '1.0.3';

    /** @var string webhookUrl */
    private $webhookUrl;

    /**
     * Function getVersion
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/03/2020 26:17
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Function setWebHook
     *
     * @param string $webhookUrl
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/10/2020 01:38
     */
    public function setWebHook(string $webhookUrl = '')
    {
        $this->webhookUrl = $webhookUrl;

        return $this;
    }

    /**
     * Function simpleMessage
     *
     * @param string $title
     * @param string $text
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/10/2020 01:51
     */
    public function simpleMessage(string $title = 'Simple card title', string $text = 'Simple card text')
    {
        try {
            // create connector instance
            $connector = new TeamsConnector($this->webhookUrl);
            // create card
            $data = array('title' => $title, 'text' => $text);
            $card = new SimpleCard($data);
            $connector->send($card);

            return TRUE;
        }
        catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', $e->getMessage());
                log_message('error', $e->getTraceAsString());
            }

            return FALSE;
        }
    }

    /**
     * Function sendCardMessage
     *
     * @param \Sebbmyr\Teams\TeamsConnectorInterface $card
     *
     * @return bool
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 10/10/2020 13:38
     */
    public function sendCardMessage(TeamsConnectorInterface $card)
    {
        try {
            // create connector instance
            $connector = new TeamsConnector($this->webhookUrl);
            $connector->send($card);

            return TRUE;
        }
        catch (Exception $e) {
            if (function_exists('log_message')) {
                log_message('error', $e->getMessage());
                log_message('error', $e->getTraceAsString());
            }

            return FALSE;
        }

    }

}
