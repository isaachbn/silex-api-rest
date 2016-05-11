<?php
/**
 * Created by PhpStorm.
 * User: isaachbn
 * Date: 09/05/16
 * Time: 19:46
 */
namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class User
 * @package App\Controllers
 */
class UserController extends BaseController
{
    /**
     * @return JsonResponse
     */
    public function getAll()
    {
        return new JsonResponse([]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request)
    {
        $note = $this->getDataFromRequest($request);
        return new JsonResponse(array("id" => $this->service->save($note)));
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(int $id, Request $request)
    {
        $note = $this->getDataFromRequest($request);
        $this->service->update($id, $note);

        return new JsonResponse($note);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id)
    {
        return new JsonResponse($this->service->delete($id));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getDataFromRequest(Request $request)
    {
        return $note = ["note" => $request->request->get("note")];
    }
}