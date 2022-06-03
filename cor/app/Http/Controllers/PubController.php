<?php

namespace App\Http\Controllers;

use App\Http\Requests\PubRequest;
use Illuminate\Http\Request;
use App\Repositories\Pub\PubRepositoryInterface;
use App\Models\User;
use App\Exports\PubsExport;
use Maatwebsite\Excel\Facades\Excel;
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

        $pubs = $this->pubRepo->getProduct($request);

        $data = [
            'pubs' => $pubs,
            'start_date_value' => $start_date_value,
            'keyword' => $request->keyword,
            'users_value' => $users_value,
            'users' => $request->users,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];
        return view('pubs.list' ,$data);

    }

    public function create()
    {
        $users = User::get(['id', 'name']);
        return view('pubs.create', compact('users'));
    }

    public function store(PubRequest $request)
    {
        $this->pubRepo->postCreate($request);

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
        $this->pubRepo->postUpdate($request, $id);

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
