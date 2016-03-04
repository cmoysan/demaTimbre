<?php

namespace Dematimbre\Si\Component\Customer\Tests\Entity;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Dematimbre\Si\Component\Customer\Entity\PersonCollection;
use PHPUnit_Framework_TestCase;

/**
 * Unit test class for PersonCollection.php.
 *
 * @see Dematimbre\Si\Component\Customer\Entity\PersonCollection
 */
class PersonCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * tests deserialize() method.
     */
    public function testDeserialize()
    {
        $collection = new PersonCollection();
        $collection->deserialize(array(
            array('id' => 3),
            array('id' => 14),
            array('id' => 15),
        ));

        $this->assertEquals(
            new PersonCollection(array(
                3 => (new Person())->setId(3),
                14 => (new Person())->setId(14),
                15 => (new Person())->setId(15),
            )),
            $collection,
            'PersonCollection from serialization is same has if it was initialized with full filled Person.'
        );
    }
}
