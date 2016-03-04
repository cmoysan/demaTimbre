<?php

namespace Dematimbre\Si\Component\Customer\Event;

use Dematimbre\Si\Component\Customer\Entity\Person;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * Person specific event class.
 */
class PersonEvent
    extends BroadcastableEvent
{
    protected $person;

    /**
     * construct.
     *
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    /**
     * return related.
     *
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @see BroadcastableEventInterface::getData()
     */
    public function getData()
    {
        return array(
            'person_id' => $this->getPerson()->getId(),
        );
    }
}
