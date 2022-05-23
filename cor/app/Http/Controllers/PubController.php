<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Pub\PubRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\File as File2;

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

    public function index()
    {
        $pubs = $this->pubRepo->getProduct();

        return view('pub.list', compact('pubs'));
    }

    public function create()
    {
        $users = User::select('id','name')->get();
        return view('pub.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $files = [];
        if($request->hasfile('images'))
		{
			foreach($request->file('images') as $file)
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
        $users = User::select('id','name')->get();
        $array_pubs_users = $pubs->pubs_users->pluck('id')->toArray();
        return view('pub.edit', compact('pubs', 'users', 'array_pubs_users'));
    }

    public function update(Request $request, $id)
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
}
