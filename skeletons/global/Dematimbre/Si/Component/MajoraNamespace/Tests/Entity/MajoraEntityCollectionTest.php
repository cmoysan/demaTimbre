<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Tests\Entity;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntityCollection;
use PHPUnit_Framework_TestCase;

/**
 * Unit test class for MajoraEntityCollection.php.
 *
 * @see Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntityCollection
 */
class MajoraEntityCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * tests deserialize() method.
     */
    public function testDeserialize()
    {
        $collection = new MajoraEntityCollection();
        $collection->deserialize(array(
            array('id' => 3),
            array('id' => 14),
            array('id' => 15),
        ));

        $this->assertEquals(
            new MajoraEntityCollection(array(
                3 => (new MajoraEntity())->setId(3),
                14 => (new MajoraEntity())->setId(14),
                15 => (new MajoraEntity())->setId(15),
            )),
            $collection,
            'MajoraEntityCollection from serialization is same has if it was initialized with full filled MajoraEntity.'
        );
    }
}
