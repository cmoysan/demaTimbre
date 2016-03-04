<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Repository\Doctrine;

use Dematimbre\Si\Component\MajoraNamespace\Repository\Doctrine\Auto\MajoraEntityDoctrineRepositoryTrait;
use Dematimbre\Si\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;
use Majora\Framework\Repository\RepositoryInterface;

/**
 * MajoraEntity repository implementation using Doctrine.
 */
class MajoraEntityDoctrineRepository extends BaseDoctrineRepository
    implements MajoraEntityRepositoryInterface, RepositoryInterface
{
    use MajoraEntityDoctrineRepositoryTrait;
}
