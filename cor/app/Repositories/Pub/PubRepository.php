<?php
namespace App\Repositories\Pub;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\File as File2;

class PubRepository extends BaseRepository implements PubRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Pub::class;
    }

    public function getProduct($request)
    {
        $keyword = isset($request->keyword) ? $request->keyword : '';
        $users = isset($request->users) ? $request->users : '';
        $start_date = isset($request->start_date) ? $request->start_date : '';
        $end_date = isset($request->end_date) ? $request->end_date : '';

        $pubs = $this->model->query();

        if ($keyword) {
            $pubs = $pubs->where(function ($query) use ($keyword) {
                $query->where('product_name', 'like', '%'.$keyword.'%')
                    ->orWhere('amount', 'like', '%'.$keyword.'%')
                    ->orWhere('price', 'like', '%'.$keyword.'%');
            });
        };

        if ($users) {
            $pubs = $pubs->where('user_id', $users);
        }

        if ($end_date) {
            $pubs = $pubs->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }

        return $pubs->get();
    }

    public function getProductTrash($request)
    {
        $keyword = isset($request->keyword) ? $request->keyword : '';
        $users = isset($request->users) ? $request->users : '';
        $start_date = isset($request->start_date) ? $request->start_date : '';
        $end_date = isset($request->end_date) ? $request->end_date : '';

        $pubs = $this->model->query();

        if ($keyword) {
            $pubs = $pubs->where(function ($query) use ($keyword) {
                $query->where('product_name', 'like', '%'.$keyword.'%')
                    ->orWhere('amount', 'like', '%'.$keyword.'%')
                    ->orWhere('price', 'like', '%'.$keyword.'%');
            });
        };

        if ($users) {
            $pubs = $pubs->where('user_id', $users);
        }

        if ($end_date) {
            $pubs = $pubs->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }

        return $pubs->onlyTrashed()->get();
    }

    public function getRecord($id)
    {
        return $this->model->withTrashed()->where('id', $id)->restore();
    }

    public function getForceDelete($id)
    {
        return $this->model->withTrashed()->where('id', $id)->forceDelete();
    }

    public function postCreate($request)
    {
        $data = $request->all();

        $files = [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time().rand(1, 100).'.'.$file->extension();
                $file->move(public_path('files_pubs'), $name);
                $files[] = $name;
            }
        }

        $pubs = $this->model->create($data);

        $pubs->images = $files;
        $pubs->pubsUsers()->attach($request->pubs_users);

        $pubs->save();
    }

    public function postUpdate($request, $id)
    {
        $data = $request->all();

        $atrributes = $this->model->find($id);
        $atrributes->update($data);

        $files = [];
        $files_remove = [];
        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = time().rand(1, 100).'.'.$file->extension();
                $file->move(public_path('files_pubs'), $name);
                $files[] = $name;
            }
        }

        if (isset($data['images_uploaded'])) {
            $files_remove = array_diff(json_decode($data['images_uploaded_origin']), $data['images_uploaded']);
            $files = array_merge($data['images_uploaded'], $files);
        } else {
            $files_remove = json_decode($data['images_uploaded_origin']);
        }

        $atrributes->images = $files;
        $atrributes->pubsUsers()->sync($request->pubs_users);

        if ($atrributes->save()) {
            foreach ($files_remove as $file_name) {
                File2::delete(public_path("files_pubs/".$file_name));
            }
        }
    }
}
