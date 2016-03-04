<?php

namespace Dematimbre\Si\Component\Customer\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * Person model collection class.
 */
class PersonCollection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return 'Dematimbre\Si\Component\Customer\Entity\Person';
    }
}
