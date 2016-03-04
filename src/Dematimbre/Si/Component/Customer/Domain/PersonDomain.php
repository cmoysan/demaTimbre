<?php

namespace Dematimbre\Si\Component\Customer\Domain;

use Dematimbre\Si\Component\Customer\Domain\Auto\PersonDomainTrait;
use Majora\Framework\Domain\AbstractDomain;

/**
 * Person domain use cases class.
 *
 * Auto generated methods :
 *
 * @method __construct(PersonRepositoryInterface $personRepository)
 * @method create(Person $person)
 * @method edit(Person $person)
 * @method delete(Person $person)
 *
 * @property personRepository
 */
class PersonDomain extends AbstractDomain
{
    use PersonDomainTrait;
}
