<?php
namespace BrauneDigital\VotingBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Braune Digital GmbH
 * @author Patrick Rathje <pr@braune-digital.com>
 * @date 15.08.16
 */

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('value');
    }

    public function getName()
    {
        'bd_voting_form_vote_type';
    }
}