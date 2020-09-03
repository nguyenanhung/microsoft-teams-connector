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

/**
 * Class MicrosoftTeamsConnector
 *
 * @package   nguyenanhung\Microsoft\Teams
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class MicrosoftTeamsConnector
{
    const VERSION = '1.0.0';

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
     * @time     : 09/03/2020 36:05
     */
    public function setWebHook($webhookUrl = '')
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
     * @time     : 09/03/2020 37:12
     */
    public function simpleMessage($title = 'Simple card title', $text = 'Simple card text')
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
}
