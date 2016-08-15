<?php
namespace BrauneDigital\VotingBundle\Entity;
/**
 * Patrick Rathje <pr@braune-digital.com>
 * Braune Digital GmbH
 * 15.08.16
 */


use BrauneDigital\VotingBundle\Model\BaseVote as BaseVoteModel;

abstract class BaseVote extends BaseVoteModel
{
    protected $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}