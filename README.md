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
## Usage


## TODO
* Create basic ReadMe
* actually submit bundle to packagist
