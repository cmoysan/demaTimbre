<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Domain;

use Dematimbre\Si\Component\MajoraNamespace\Domain\Auto\MajoraEntityDomainTrait;
use Majora\Framework\Domain\AbstractDomain;

/**
 * MajoraEntity domain use cases class.
 *
 * Auto generated methods :
 *
 * @method __construct(MajoraEntityRepositoryInterface $majoraEntityRepository)
 * @method create(MajoraEntity $majoraEntity)
 * @method edit(MajoraEntity $majoraEntity)
 * @method delete(MajoraEntity $majoraEntity)
 *
 * @property majoraEntityRepository
 */
class MajoraEntityDomain extends AbstractDomain
{
    use MajoraEntityDomainTrait;
}
