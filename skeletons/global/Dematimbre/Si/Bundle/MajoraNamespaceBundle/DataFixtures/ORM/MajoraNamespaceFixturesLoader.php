<?php

namespace Dematimbre\Si\Bundle\MajoraNamespaceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;

/**
 * Fixtures loader for MajoraNamespace bundle.
 *
 * @see @MajoraNamespaceBundle/Resources/fixtures/majora_entitys.yml
 */
class MajoraNamespaceFixturesLoader extends DataFixtureLoader implements OrderedFixtureInterface
{
    /**
     * Returns an array of file paths to fixtures.
     *
     * @return array<string>
     */
    protected function getFixtures()
    {
        return array(
            // __DIR__ . '/../../Resources/fixtures/majora_entitys.yml',
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
