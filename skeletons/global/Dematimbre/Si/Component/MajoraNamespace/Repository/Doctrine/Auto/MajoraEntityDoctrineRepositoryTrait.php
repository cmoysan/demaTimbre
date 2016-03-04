<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Repository\Doctrine\Auto;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntityCollection;
use Majora\Framework\Repository\Doctrine\DoctrineRepositoryTrait;

/**
 * MajoraEntity repository trait for Doctrine.
 *
 * @MajoraGenerator({"force_generation": true})
 * @codeCoverageIgnore()
 */
trait MajoraEntityDoctrineRepositoryTrait
{
    use DoctrineRepositoryTrait;

    /**
     * Force force given entity to MajoraEntityCollection.
     *
     * @param MajoraEntityCollection|MajoraEntity $majoraEntitys
     *
     * @return MajoraEntityCollection
     */
    private function castToMajoraEntityCollection($majoraEntitys)
    {
        return $majoraEntitys instanceof MajoraEntityCollection ?
            $majoraEntitys :
            new MajoraEntityCollection(array($majoraEntitys))
        ;
    }

    /**
     * @see MajoraEntityRepositoryInterface::save()
     */
    public function save($majoraEntitys)
    {
        $this->castToMajoraEntityCollection($majoraEntitys)
            ->forAll(function ($key, MajoraEntity $majoraEntity) {
                $this->getEntityManager()->persist($majoraEntity);

                return true;
            })
        ;

        $this->getEntityManager()->flush();

        return $majoraEntitys;
    }

    /**
     * @see MajoraEntityRepositoryInterface::delete()
     */
    public function delete($majoraEntitys)
    {
        $this->castToMajoraEntityCollection($majoraEntitys)
            ->forAll(function ($key, MajoraEntity $majoraEntity) {
                $this->getEntityManager()->remove($majoraEntity);

                return true;
            })
        ;

        $this->getEntityManager()->flush();

        return $majoraEntitys;
    }
}
