<?php
/**
 * Created by PhpStorm.
 * User: isaachbn
 * Date: 09/05/16
 * Time: 20:18
 */
namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface BaseInterfaceController
 * @package App\Controllers
 */
interface BaseInterfaceController
{
    public function getAll();

    public function save(Request $request);

    public function update(int $id, Request $request);

    public function delete(int $id);

    public function getDataFromRequest(Request $request);
}