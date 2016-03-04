<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Domain\Auto;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Dematimbre\Si\Component\MajoraNamespace\Event\MajoraEntityEvent;
use Dematimbre\Si\Component\MajoraNamespace\Event\MajoraEntityEvents;
use Dematimbre\Si\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface;
use Majora\Framework\Domain\DomainTrait;

/**
 * MajoraEntity domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @codeCoverageIgnore
 *
 * @see DomainTrait::assertEntityIsValid()
 * @see DomainTrait::fireEvent()
 */
trait MajoraEntityDomainTrait
{
    use DomainTrait;

    protected $majoraEntityRepository;

    /**
     * construct.
     *
     * @param MajoraEntityRepositoryInterface $majoraEntityRepository
     */
    public function __construct(
        MajoraEntityRepositoryInterface $majoraEntityRepository
    ) {
        $this->majoraEntityRepository = $majoraEntityRepository;
    }

    /**
     * Process given MajoraEntity creation process.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function create(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'creation');

        $this->majoraEntityRepository->save($majoraEntity);

        $this->fireEvent(
            MajoraEntityEvents::DEMATIMBRE_MAJORA_ENTITY_CREATED,
            new MajoraEntityEvent($majoraEntity)
        );
    }

    /**
     * Process given MajoraEntity edition process.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function edit(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'edition');

        $this->majoraEntityRepository->save($majoraEntity);

        $this->fireEvent(
            MajoraEntityEvents::DEMATIMBRE_MAJORA_ENTITY_EDITED,
            new MajoraEntityEvent($majoraEntity)
        );
    }

    /**
     * Enable given MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function enable(MajoraEntity $majoraEntity)
    {
        return $this->edit(
            $majoraEntity->enable()
        );
    }

    /**
     * Disable given MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function disable(MajoraEntity $majoraEntity)
    {
        return $this->edit(
            $majoraEntity->disable()
        );
    }

    /**
     * Process given MajoraEntity deletion process.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        $this->assertEntityIsValid($majoraEntity, 'deletion');

        $this->majoraEntityRepository->delete($majoraEntity);

        $this->fireEvent(
            MajoraEntityEvents::DEMATIMBRE_MAJORA_ENTITY_DELETED,
            new MajoraEntityEvent($majoraEntity)
        );
    }
}
