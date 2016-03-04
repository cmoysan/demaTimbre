<?php

namespace Dematimbre\Si\Component\Customer\Tests\Repository\Doctrine\Auto;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Dematimbre\Si\Component\Customer\Repository\Doctrine\PersonDoctrineRepository;

/**
 * Tests traits for PersonDoctrineRepositoryTest PHPUnit test case class.
 *
 * @MajoraGenerator({"force_generation": true})
 */
trait PersonDoctrineRepositoryTestTrait
{
    /**
     * test save() method.
     */
    public function testSave()
    {
        $entity = new Person();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->persist($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new PersonDoctrineRepository(
            $em->reveal(),
            $this->prophesize('Doctrine\ORM\Mapping\ClassMetadata')->reveal()
        );

        $this->assertEquals(
            $entity,
            $repository->save($entity),
            'Repository returns saved object.'
        );
    }

    /**
     * test delete() method.
     */
    public function testDelete()
    {
        $entity = new Person();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->remove($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new PersonDoctrineRepository(
            $em->reveal(),
            $this->prophesize('Doctrine\ORM\Mapping\ClassMetadata')->reveal()
        );

        $this->assertEquals(
            $entity,
            $repository->delete($entity),
            'Repository returns deleted object.'
        );
    }
}
