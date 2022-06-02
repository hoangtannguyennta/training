<?php

namespace App\Http\Controllers;

use App\Http\Requests\PubRequest;
use Illuminate\Http\Request;
use App\Repositories\Pub\PubRepositoryInterface;
use App\Models\User;
use App\Exports\PubsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File as File2;
use Carbon\Carbon;

class PubController extends Controller
{
    /**
     * @var PubRepositoryInterface|\App\Repositories\Repository
     */
    protected $pubRepo;

    public function __construct(PubRepositoryInterface $pubRepo)
    {
        $this->middleware('auth');
        $this->pubRepo = $pubRepo;
    }

    public function index(Request $request)
    {
        $users_value = User::get(['id', 'name']);
        $start_date_value = Carbon::now()->subDay(30)->format('Y-m-d');

        $keyword = isset($request->keyword) ? $request->keyword : '';
        $users = isset($request->users) ? $request->users : '';
        $users_many = isset($request->users_many) ? $request->users_many : '';
        $start_date = isset($request->start_date) ? $request->start_date : '';
        $end_date = isset($request->end_date) ? $request->end_date : '';


        $pubs = $this->pubRepo->getProduct();

        if ($keyword) {
            $pubs = $pubs->where(function ($query) use ($keyword) {
                $query->where('product_name','like','%'.$keyword.'%')
                    ->orWhere('amount','like','%'.$keyword.'%')
                    ->orWhere('price','like','%'.$keyword.'%');
                });
        };

        if ($users) {
            $pubs = $pubs->where('user_id',$users);
        }

        if ($end_date) {
            $pubs = $pubs->whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date);
        }

        $pubs =  $pubs->paginate(10);
        return view('pubs.list', compact('pubs', 'keyword', 'users_value', 'users', 'users_many','start_date', 'start_date_value', 'end_date'));
    }

    public function create()
    {
        $users = User::get(['id', 'name']);
        return view('pubs.create', compact('users'));
    }

    public function store(PubRequest $request)
    {
        $data = $request->all();

        $files = [];
        if ($request->hasfile('images'))
		{
			foreach ($request->file('images') as $file)
			{
			    $name = time().rand(1,100).'.'.$file->extension();
			    $file->move(public_path('files_pubs'), $name);
			    $files[] = $name;
			}
		}

        $pub = $this->pubRepo->create($data);
        $pub->images = $files;
        $pub->pubs_users()->attach($request->pubs_users);
		$pub->save();

        return redirect()->route('pubs.create')->with('success','#');
    }

    public function edit($id)
    {
        $pubs = $this->pubRepo->find($id);
        $users = User::get(['id', 'name']);
        $array_pubs_users = $pubs->pubs_users->pluck('id')->toArray();
        return view('pubs.edit', compact('pubs', 'users', 'array_pubs_users'));
    }

    public function update(PubRequest $request, $id)
    {
        $data = $request->all();

        $pub = $this->pubRepo->update($id, $data);

        $files = [];
        $files_remove = [];
        if($request->hasfile('images'))
		{
			foreach($request->file('images') as $file)
			{
			    $name = time().rand(1,100).'.'.$file->extension();
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

		$pub->images = $files;
        $pub->pubs_users()->sync($request->pubs_users);
		if($pub->save()) {
			foreach ($files_remove as $file_name) {
				File2::delete(public_path("files_pubs/".$file_name));
			}
		}

        return redirect()->back()->with('success','#');
    }

    public function destroy($id)
    {
        $this->pubRepo->delete($id);

        return redirect()->route('pubs.index')->with('success','#');
    }

    public function exportEx()
    {
        return Excel::download(new PubsExport, 'Danh sách hàng hoá ' . Carbon::now()->format('d-m-Y') . '.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new PubsExport, 'Danh sách hàng hoá ' . Carbon::now()->format('d-m-Y') . '.csv');
    }
}
