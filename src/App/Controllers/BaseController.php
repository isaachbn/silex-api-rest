<?php

namespace App\Controllers;

use App\Services\BaseInterfaceService;

/**
 * Class BaseController
 * @package App\Controllers
 */
abstract class BaseController implements BaseInterfaceController
{
    /**
     * @var BaseInterfaceService
     */
    protected $service;

    /**
     * BaseController constructor.
     * @param BaseInterfaceService $service
     */
    public function __construct(BaseInterfaceService $service)
    {
        $this->service = $service;
    }
}