<?php

namespace Dematimbre\Si\Component\Customer\Domain\Auto;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Dematimbre\Si\Component\Customer\Event\PersonEvent;
use Dematimbre\Si\Component\Customer\Event\PersonEvents;
use Dematimbre\Si\Component\Customer\Repository\PersonRepositoryInterface;
use Majora\Framework\Domain\DomainTrait;

/**
 * Person domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @codeCoverageIgnore
 *
 * @see DomainTrait::assertEntityIsValid()
 * @see DomainTrait::fireEvent()
 */
trait PersonDomainTrait
{
    use DomainTrait;

    protected $personRepository;

    /**
     * construct.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(
        PersonRepositoryInterface $personRepository
    ) {
        $this->personRepository = $personRepository;
    }

    /**
     * Process given Person creation process.
     *
     * @param Person $person
     */
    public function create(Person $person)
    {
        $this->assertEntityIsValid($person, 'creation');

        $this->personRepository->save($person);

        $this->fireEvent(
            PersonEvents::DEMATIMBRE_PERSON_CREATED,
            new PersonEvent($person)
        );
    }

    /**
     * Process given Person edition process.
     *
     * @param Person $person
     */
    public function edit(Person $person)
    {
        $this->assertEntityIsValid($person, 'edition');

        $this->personRepository->save($person);

        $this->fireEvent(
            PersonEvents::DEMATIMBRE_PERSON_EDITED,
            new PersonEvent($person)
        );
    }

    /**
     * Enable given Person.
     *
     * @param Person $person
     */
    public function enable(Person $person)
    {
        return $this->edit(
            $person->enable()
        );
    }

    /**
     * Disable given Person.
     *
     * @param Person $person
     */
    public function disable(Person $person)
    {
        return $this->edit(
            $person->disable()
        );
    }

    /**
     * Process given Person deletion process.
     *
     * @param Person $person
     */
    public function delete(Person $person)
    {
        $this->assertEntityIsValid($person, 'deletion');

        $this->personRepository->delete($person);

        $this->fireEvent(
            PersonEvents::DEMATIMBRE_PERSON_DELETED,
            new PersonEvent($person)
        );
    }
}
