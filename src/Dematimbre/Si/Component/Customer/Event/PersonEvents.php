<?php

namespace Dematimbre\Si\Component\Customer\Event;

/**
 * Person event reference class.
 */
final class PersonEvents
{
    /**
     * event fired when a person is created.
     */
    const DEMATIMBRE_PERSON_CREATED = 'dematimbre.person.created';

    /**
     * event fired when a person is updated.
     */
    const DEMATIMBRE_PERSON_EDITED = 'dematimbre.person.edited';

    /**
     * event fired when a person is deleted.
     */
    const DEMATIMBRE_PERSON_DELETED = 'dematimbre.person.deleted';
}
