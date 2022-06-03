<?php
namespace App\Repositories\Pub;

use App\Repositories\RepositoryInterface;

interface PubRepositoryInterface extends RepositoryInterface
{
    public function getProduct($request);
    public function getProductTrash($id);
    public function getForceDelete($id);
    public function getRecord($request);
    public function postCreate($request);
    public function postUpdate($request,$id);
}
