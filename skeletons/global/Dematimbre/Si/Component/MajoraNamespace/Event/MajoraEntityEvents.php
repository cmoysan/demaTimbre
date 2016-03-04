<?php

namespace Dematimbre\Si\Component\MajoraNamespace\Event;

/**
 * MajoraEntity event reference class.
 */
final class MajoraEntityEvents
{
    /**
     * event fired when a majora_entity is created.
     */
    const DEMATIMBRE_MAJORA_ENTITY_CREATED = 'dematimbre.majora_entity.created';

    /**
     * event fired when a majora_entity is updated.
     */
    const DEMATIMBRE_MAJORA_ENTITY_EDITED = 'dematimbre.majora_entity.edited';

    /**
     * event fired when a majora_entity is deleted.
     */
    const DEMATIMBRE_MAJORA_ENTITY_DELETED = 'dematimbre.majora_entity.deleted';
}
