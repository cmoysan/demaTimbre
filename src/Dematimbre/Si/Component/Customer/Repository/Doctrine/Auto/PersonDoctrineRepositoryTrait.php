<?php

namespace Dematimbre\Si\Component\Customer\Repository\Doctrine\Auto;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Dematimbre\Si\Component\Customer\Entity\PersonCollection;
use Majora\Framework\Repository\Doctrine\DoctrineRepositoryTrait;

/**
 * Person repository trait for Doctrine.
 *
 * @MajoraGenerator({"force_generation": true})
 * @codeCoverageIgnore()
 */
trait PersonDoctrineRepositoryTrait
{
    use DoctrineRepositoryTrait;

    /**
     * Force force given entity to PersonCollection.
     *
     * @param PersonCollection|Person $persons
     *
     * @return PersonCollection
     */
    private function castToPersonCollection($persons)
    {
        return $persons instanceof PersonCollection ?
            $persons :
            new PersonCollection(array($persons))
        ;
    }

    /**
     * @see PersonRepositoryInterface::save()
     */
    public function save($persons)
    {
        $this->castToPersonCollection($persons)
            ->forAll(function ($key, Person $person) {
                $this->getEntityManager()->persist($person);

                return true;
            })
        ;

        $this->getEntityManager()->flush();

        return $persons;
    }

    /**
     * @see PersonRepositoryInterface::delete()
     */
    public function delete($persons)
    {
        $this->castToPersonCollection($persons)
            ->forAll(function ($key, Person $person) {
                $this->getEntityManager()->remove($person);

                return true;
            })
        ;

        $this->getEntityManager()->flush();

        return $persons;
    }
}
