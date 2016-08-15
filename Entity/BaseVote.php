<?php
/**
 * @author Patrick Rathje <pr@braune-digital.com>
 * @company Braune Digital GmbH
 * @date 15.08.16
 */

namespace BrauneDigital\VotingBundle\Entity;

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