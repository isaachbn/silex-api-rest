<?php
/**
 * Created by PhpStorm.
 * User: isaachbn
 * Date: 09/05/16
 * Time: 19:55
 */
namespace App\Services;

/**
 * Interface BaseService
 * @package App\Services
 */
interface BaseInterfaceService
{
    public function getAll();

    public function save($object);

    public function update(int $id, $object);

    public function delete(int $id);
}