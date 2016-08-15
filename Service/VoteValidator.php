<?php
/**
 * @author Patrick Rathje <pr@braune-digital.com>
 * @company Braune Digital GmbH
 * @date 15.08.16
 */

namespace BrauneDigital\VotingBundle\Service;

use BrauneDigital\VotingBundle\Model\BaseVote;
use BrauneDigital\VotingBundle\Model\VoteLogdata;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Class VoteValidator
 * @package BrauneDigital\VotingBundle\Service
 */
class VoteValidator
{
    protected $hashAlgorithm;
    public function __construct($hashAlgorithm)
    {
        $this->hashAlgorithm = $hashAlgorithm;
    }

    /**
     * @param QueryBuilder $qb
     * @param $alias
     * @param VoteLogdata $logdata
     * @param bool $strict fingerprint and ip have to match both
     * @return QueryBuilder
     */
    public function extendQueryBuilder(QueryBuilder $qb, $alias, VoteLogdata $logdata, $strict = true) {
        $exp = [];
        if ($logdata->getIp()) {
            $exp[] = $qb->expr()->eq($alias . '.ip', ':ip');
            $qb->setParameter('ip', $this->hash($logdata->getIp()));
        }
        if ($logdata->getFingerprint()) {
            $exp[] = $qb->expr()->eq($alias . '.fingerprint', ':fingerprint');
            $qb->setParameter('fingerprint', $this->hash($logdata->getFingerprint()));
        }

        if (count($exp)) {
            if ($strict) {
                $where = call_user_func_array([$qb->expr(), 'andX'], $exp);
            } else {
                $where = call_user_func_array([$qb->expr(), 'orX'], $exp);
            }
            $qb->andWhere($where);
        }
        return $qb;
    }

    public function checkForVotes(QueryBuilder $qb, $alias, VoteLogdata $logdata, $strict = true) {
        $qb = $this->extendQueryBuilder($qb, $alias, $logdata, $strict);
        return $qb->getQuery()->getResult();
    }

    public function addLogData(BaseVote $vote, VoteLogdata $logdata) {
        $vote->setDate(new \DateTime());
        if ($logdata->getFingerprint()) {
            $vote->setFingerprint($this->hash($logdata->getFingerprint()));
        } else {
            $vote->setFingerprint(null);
        }

        if ($logdata->getIp()) {
            $vote->setIp($this->hash($logdata->getIp()));
        } else {
            $vote->setIp(null);
        }
    }

    protected function hash($data) {
        return hash($this->hashAlgorithm, $data, false);
    }
}