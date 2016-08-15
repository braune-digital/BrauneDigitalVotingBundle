<?php
/**
 * Braune Digital GmbH
 * @author Patrick Rathje <pr@braune-digital.com>
 * @date 15.08.16
 */

namespace BrauneDigital\VotingBundle\Model;

/**
 * Class VoteLogdata
 * @package BrauneDigital\VotingBundle\Model
 *
 * Data to log and identify users
 */
class VoteLogdata
{
    protected $ip;
    protected $fingerprint;

    public function __construct($ip, $fingerprint)
    {
        $this->ip = $ip;
        $this->fingerprint = $fingerprint;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getFingerprint()
    {
        return $this->fingerprint;
    }

    /**
     * @param mixed $fingerprint
     */
    public function setFingerprint($fingerprint)
    {
        $this->fingerprint = $fingerprint;
    }
}