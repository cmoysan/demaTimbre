<?php

namespace Dematimbre\Si\Component\Customer\Repository\Doctrine;

use Dematimbre\Si\Component\Customer\Repository\Doctrine\Auto\PersonDoctrineRepositoryTrait;
use Dematimbre\Si\Component\Customer\Repository\PersonRepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;
use Majora\Framework\Repository\RepositoryInterface;

/**
 * Person repository implementation using Doctrine.
 */
class PersonDoctrineRepository extends BaseDoctrineRepository
    implements PersonRepositoryInterface, RepositoryInterface
{
    use PersonDoctrineRepositoryTrait;
}
