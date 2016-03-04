<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Tests\Repository\Doctrine\Auto;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Dematimbre\Si\Component\MajoraNamespace\Repository\Doctrine\MajoraEntityDoctrineRepository;

/**
 * Tests traits for MajoraEntityDoctrineRepositoryTest PHPUnit test case class.
 *
 * @MajoraGenerator({"force_generation": true})
 */
trait MajoraEntityDoctrineRepositoryTestTrait
{
    /**
     * test save() method.
     */
    public function testSave()
    {
        $entity = new MajoraEntity();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->persist($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new MajoraEntityDoctrineRepository(
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
        $entity = new MajoraEntity();

        $em = $this->prophesize('Doctrine\ORM\EntityManager');
        $em->remove($entity)->shouldBeCalled();
        $em->flush()->shouldBeCalled();

        $repository = new MajoraEntityDoctrineRepository(
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
