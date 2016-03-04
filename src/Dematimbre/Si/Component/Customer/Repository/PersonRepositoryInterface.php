<?php

namespace Dematimbre\Si\Component\Customer\Repository;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Dematimbre\Si\Component\Customer\Entity\PersonCollection;

/**
 * Interface to implement on all Person repositories.
 */
interface PersonRepositoryInterface
{
    /**
     * update or create given Persons into persistence layer.
     *
     * @param Person|PersonCollection $persons
     */
    public function save($persons);

    /**
     * delete given Persons into persistence layer.
     *
     * @param Person|PersonCollection $persons
     */
    public function delete($persons);
}
