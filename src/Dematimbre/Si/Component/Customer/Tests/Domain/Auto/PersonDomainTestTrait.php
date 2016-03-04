<?php

namespace Dematimbre\Si\Component\Customer\Tests\Domain\Auto;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Dematimbre\Si\Component\Customer\Event\PersonEvent;
use Dematimbre\Si\Component\Customer\Event\PersonEvents;
use Prophecy\Prophecy\ObjectProphecy;

/**
 * Tests traits for PersonDomainTest PHPUnit test case class.
 *
 * @MajoraGenerator({"force_generation": true})
 */
trait PersonDomainTestTrait
{
    /**
     * Argument provider for domain creation.
     *
     * @return array()
     */
    public function domainArgumentsProvider()
    {
        return array(array(array(
            'repository' => $this->prophesize('DematimbreDEMATIMBRE\Si\Component\Customer\Repository\PersonRepositoryInterface'),
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

        $domain = (new \ReflectionClass('DematimbreDEMATIMBRE\Si\Component\Customer\Domain\PersonDomain'))
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
        $person = new Person();
        $person->setId(42);

        $repository = $arguments['repository'];
        $repository->save($person)->shouldBeCalled();

        $asserter = $this;

        $eventDispatcher = $arguments['event_dispatcher'];
        $eventDispatcher
            ->dispatch(
                PersonEvents::DEMATIMBRE_PERSON_CREATED,
                new PersonEvent($person)
            )
            ->will(function ($args) use ($person, $asserter) {
                $asserter->assertEquals($person, $args[1]->getPerson());
                $asserter->assertEquals(array('person_id' => 42), $args[1]->getData());
            })
            ->shouldBeCalled()
        ;

        $validator = $arguments['validator'];
        $validator->validate($person, null, array('creation'))->shouldBeCalled();

        $this->createDomain($arguments)
            ->create($person)
        ;
    }

    /**
     * tests edit() method.
     *
     * @dataProvider domainArgumentsProvider
     */
    public function testEdit($arguments)
    {
        $person = new Person();
        $person->setId(42);

        $repository = $arguments['repository'];
        $repository->save($person)->shouldBeCalled();

        $eventDispatcher = $arguments['event_dispatcher'];
        $eventDispatcher
            ->dispatch(
                PersonEvents::DEMATIMBRE_PERSON_EDITED,
                new PersonEvent($person)
            )
            ->shouldBeCalled()
        ;

        $validator = $arguments['validator'];
        $validator->validate($person, null, array('edition'))->shouldBeCalled();

        $this->createDomain($arguments)
            ->edit($person)
        ;
    }

    /**
     * tests delete() method.
     *
     * @dataProvider domainArgumentsProvider
     */
    public function testDelete($arguments)
    {
        $person = new Person();
        $person->setId(42);

        $repository = $arguments['repository'];
        $repository->delete($person)->shouldBeCalled();

        $eventDispatcher = $arguments['event_dispatcher'];
        $eventDispatcher
            ->dispatch(
                PersonEvents::DEMATIMBRE_PERSON_DELETED,
                new PersonEvent($person)
            )
            ->shouldBeCalled()
        ;

        $validator = $arguments['validator'];
        $validator->validate($person, null, array('deletion'))->shouldBeCalled();

        $this->createDomain($arguments)
            ->delete($person)
        ;
    }
}
