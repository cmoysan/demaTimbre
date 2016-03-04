<?php

/* @MajoraGenerator({"force_generation": true}) */

namespace Dematimbre\Si\Component\MajoraNamespace\Loader\Doctrine\Auto;

use Majora\Framework\Loader\LoaderTrait;

/**
 * Default MajoraEntity loader implementation trait.
 */
trait MajoraEntityDoctrineLoaderTrait
{
    use LoaderTrait;

    /**
     * @var Closure|null
     */
    protected $loadingDelegate;

    /**
     * @see DoctrineLoaderInterface::getDelegate()
     */
    public function getDelegate()
    {
        return $this->loadingDelegate;
    }
}
