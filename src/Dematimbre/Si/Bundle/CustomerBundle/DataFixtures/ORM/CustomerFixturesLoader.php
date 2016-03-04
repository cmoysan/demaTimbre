<?php

namespace Dematimbre\Si\Bundle\CustomerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * Fixtures loader for Customer bundle.
 *
 * @see @CustomerBundle/Resources/fixtures/persons.yml
 */
class CustomerFixturesLoader extends DataFixtureLoader implements OrderedFixtureInterface
{
    /**
     * Returns an array of file paths to fixtures.
     *
     * @return array<string>
     */
    protected function getFixtures()
    {
        return array(
            // __DIR__ . '/../../Resources/fixtures/persons.yml',
        );
    }

    /**
     * Get the order of this fixture.
     *
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
