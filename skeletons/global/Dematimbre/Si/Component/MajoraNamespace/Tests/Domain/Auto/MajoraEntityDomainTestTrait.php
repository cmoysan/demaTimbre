<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Tests\Domain\Auto;

use Dematimbre\Si\Component\MajoraNamespace\Entity\MajoraEntity;
use Dematimbre\Si\Component\MajoraNamespace\Event\MajoraEntityEvent;
use Dematimbre\Si\Component\MajoraNamespace\Event\MajoraEntityEvents;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Tests traits for MajoraEntityDomainTest PHPUnit test case class.
 *
 * @MajoraGenerator({"force_generation": true})
 */
trait MajoraEntityDomainTestTrait
{
    /**
     * Argument provider for domain creation.
     *
     * @return array()
     */
    public function domainArgumentsProvider()
    {
        return array(array(array(
            'repository' => $this->prophesize('DematimbreDEMATIMBRE\Si\Component\MajoraNamespace\Repository\MajoraEntityRepositoryInterface'),
            'event_dispatcher' => $this->prophesize('Symfony\Component\EventDispatcher\EventDispatcherInterface'),
            'validator' => $this->prophesize('Symfony\Component\Validator\Validator\ValidatorInterface'),
        )));
    }

    /**
     * create domain.
     */
    public function createDomain($arguments)
    {
        $eventDispatcher = $arguments['event_dispatcher'];
        $validator = $arguments['validator'];

        unset($arguments['event_dispatcher']);
        unset($arguments['validator']);

        $domain = (new \ReflectionClass('DematimbreDEMATIMBRE\Si\Component\MajoraNamespace\Domain\MajoraEntityDomain'))
            ->newInstanceArgs(array_map(function ($class) {
                return $class instanceof ObjectProphecy ?
                    $class->reveal() : $class
                ;
            }, array_values($arguments)))
        ;
        $domain->setEventDispatcher($eventDispatcher->reveal());
        $domain->setValidator($validator->reveal());

        return $domain;
    }

    /**
     * tests create() method.
     *
     * @dataProvider domainArgumentsProvider
     */
    public function testCreate($arguments)
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $arguments['repository'];
        $repository->save($majoraEntity)->shouldBeCalled();

        $asserter = $this;

        $eventDispatcher = $arguments['event_dispatcher'];
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::DEMATIMBRE_MAJORA_ENTITY_CREATED,
                new MajoraEntityEvent($majoraEntity)
            )
            ->will(function ($args) use ($majoraEntity, $asserter) {
                $asserter->assertEquals($majoraEntity, $args[1]->getMajoraEntity());
                $asserter->assertEquals(array('majora_entity_id' => 42), $args[1]->getData());
            })
            ->shouldBeCalled()
        ;

        $validator = $arguments['validator'];
        $validator->validate($majoraEntity, null, array('creation'))->shouldBeCalled();

        $this->createDomain($arguments)
            ->create($majoraEntity)
        ;
    }

    /**
     * tests edit() method.
     *
     * @dataProvider domainArgumentsProvider
     */
    public function testEdit($arguments)
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $arguments['repository'];
        $repository->save($majoraEntity)->shouldBeCalled();

        $eventDispatcher = $arguments['event_dispatcher'];
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::DEMATIMBRE_MAJORA_ENTITY_EDITED,
                new MajoraEntityEvent($majoraEntity)
            )
            ->shouldBeCalled()
        ;

        $validator = $arguments['validator'];
        $validator->validate($majoraEntity, null, array('edition'))->shouldBeCalled();

        $this->createDomain($arguments)
            ->edit($majoraEntity)
        ;
    }

    /**
     * tests delete() method.
     *
     * @dataProvider domainArgumentsProvider
     */
    public function testDelete($arguments)
    {
        $majoraEntity = new MajoraEntity();
        $majoraEntity->setId(42);

        $repository = $arguments['repository'];
        $repository->delete($majoraEntity)->shouldBeCalled();

        $eventDispatcher = $arguments['event_dispatcher'];
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::DEMATIMBRE_MAJORA_ENTITY_DELETED,
                new MajoraEntityEvent($majoraEntity)
            )
            ->shouldBeCalled()
        ;

        $validator = $arguments['validator'];
        $validator->validate($majoraEntity, null, array('deletion'))->shouldBeCalled();

        $this->createDomain($arguments)
            ->delete($majoraEntity)
        ;
    }
}
