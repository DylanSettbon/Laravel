<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Group;


use App\Repositories\GroupRepository;

use Illuminate\Http\Request;

class GroupController extends Controller
{
     protected $groupRepository;

    protected $nbrPerPage = 4;

    public function __construct(GroupRepository $groupRepository)
    {
		$this->groupRepository = $groupRepository;
	}

	public function index()
	{
		//$groups=\App\Group::all();
		$groups = $this->groupRepository->getPaginate($this->nbrPerPage);
		$links = $groups->setPath('')->render();
		
		return view('index', compact('groups', 'links'));
	}

	public function create()
	{
		return view('create');
	}

	public function store(GroupCreateRequest $request)
	{
		$group = $this->groupRepository->store($request->all());

		return redirect('group')->withOk("Le groupe " . $group->title . " a été créé.");
	}

	public function show($id)
	{
		$group = $this->groupRepository->getById($id);

		//recup la liste des amis
		/*$amis = Relations::where('status', '=', 'accepted')
		->where(function ($query) {
			$query->where('idReceiver', '=', Auth::id())
				->orWhere('idSender', '=', Auth::id())
		);
		->get();*/




		return view('show',  compact('group', 'amis'));
	}

	public function edit($id)
	{
		$group = $this->groupRepository->getById($id);

		return view('edit',  compact('group'));
	}


	public function update(GroupUpdateRequest $request)
	{
		
			$groupUpdate = Group::find( $request->input('id') );
			
			$groupUpdate->title = $request->input('title');
			$groupUpdate->save();

		
		return redirect('group')->withOk("Le groupe" . $request->input('title') . " a été modifié.");
	}

	public function destroy($id)
	{
		$this->groupRepository->destroy($id);

		return redirect()->back();
	}
}
