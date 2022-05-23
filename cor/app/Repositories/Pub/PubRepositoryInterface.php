<?php
namespace App\Repositories\Pub;

use App\Repositories\RepositoryInterface;

interface PubRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getProduct();
}
