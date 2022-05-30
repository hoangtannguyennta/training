<?php
namespace App\Repositories\Pub;

use App\Repositories\BaseRepository;

class PubRepository extends BaseRepository implements PubRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Pub::class;
    }

    public function getProduct()
    {
        return $this->model->query();
    }
}
