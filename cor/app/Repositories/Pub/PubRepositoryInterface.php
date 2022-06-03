<?php
namespace App\Repositories\Pub;

use App\Repositories\RepositoryInterface;

interface PubRepositoryInterface extends RepositoryInterface
{
    public function getProduct($request);
    public function postCreate($request);
    public function postUpdate($request,$id);
}
