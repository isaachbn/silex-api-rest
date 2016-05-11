<?php

namespace App\Services;

use JMS\Serializer\Serializer;

/**
 * Class BaseService
 * @package App\Services
 */
abstract class BaseService implements BaseInterfaceService
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * BaseService constructor.
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
}
