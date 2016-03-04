<?php

namespace Dematimbre\Si\Component\Customer\Loader\Doctrine;

use Dematimbre\Si\Component\Customer\Loader\Doctrine\Auto\PersonDoctrineLoaderTrait;
use Dematimbre\Si\Component\Customer\Loader\PersonLoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * Person loader implementation using Doctrine.
 */
class PersonDoctrineLoader extends AbstractDoctrineLoader
    implements PersonLoaderInterface
{
    use PersonDoctrineLoaderTrait;
}
