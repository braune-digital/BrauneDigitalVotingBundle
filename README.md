# BrauneDigitalVotingBundle
This Symfony-Bundle provides a base for your voting functionality.

## Installation

In order to install this Bundle you will need:
* Doctrine ORM (required) -> Entity-Persistence

Just run the following command to install this bundle:
```
composer require braune-digital/voting-bundle
```

And enable the Bundle in your AppKernel.php:
```php
public function registerBundles()
    {
        $bundles = array(
          ...
          new BrauneDigital\VotingBundle\BrauneDigitalVotingBundle(),
          ...
        );
```
## Extend using Sonata Easy Extend

```
php app/console sonata:easy-extends:generate BrauneDigitalVotingBundle -d src
```

And add this to your AppKernel as well:
```php
public function registerBundles()
    {
        $bundles = array(
          ...
          new Application\BrauneDigital\VotingBundle\ApplicationBrauneDigitalVotingBundle(),
          ...
        );
```

## Now feel free to add your votes (for example a vote for a post entity):


File: Application\BrauneDigital\Entity\PostVote
```
<?php
/**
 * @author Patrick Rathje <pr@braune-digital.com>
 * @company Braune Digital GmbH
 * @date 15.08.16
 */

namespace Application\BrauneDigital\VotingBundle\Entity;

class PostVote extends Vote
{
    protected $post;

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }
}
```

Do not forget the votes property on the inversing side as well.


File: Application\BrauneDigital\Resources\config\doctrine\PostVote.orm.yml
```
Application\BrauneDigital\VotingBundle\Entity\PostVote:
    type: entity
    table: bd_voting_vote_post
    manyToOne:
        post:
            targetEntity: 'AppBundle\Entity\Post'
            fetch: LAZY
            mappedBy: votes
```

Part of File: AppBundle\Resources\config\doctrine\Post.orm.yml

```
oneToMany:
    votes:
        targetEntity: 'Application\BrauneDigital\VotingBundle\Entity\PostVote'
        mappedBy: post
```

At last you have to add your entity to the descriminator mapping:
Part of File: Application\BrauneDigital\Resources\config\doctrine\Vote.orm.yml
```
Application\BrauneDigital\VotingBundle\Entity\Vote:
    ...
    discriminatorMap:
        vote: Application\BrauneDigital\VotingBundle\Entity\Vote
        post: Application\BrauneDigital\VotingBundle\Entity\PostVote
    ...
```
Now update your schema and you should be ready to go.
## TODO
* actually submit bundle to packagist
