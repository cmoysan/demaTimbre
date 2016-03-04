<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * MajoraEntity model collection class.
 */
class MajoraEntityCollection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return 'Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity';
    }
}
