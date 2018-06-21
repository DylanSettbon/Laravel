<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\User;
use App\Group;
use Auth;
use DB;



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
		$id = Auth::User()->id;
		$idFriends = User::getFriends();
		foreach($idFriends as $idFriend) {
			$friends[] = DB::table('users')->where('id', '=', $idFriend)->first();
		}
//		dd($friends);
		return view('create', compact('friends'));
	}

	public function store(GroupCreateRequest $request)
	{
		$group = $this->groupRepository->store($request->all());

		return redirect('group')->withOk("Le groupe " . $group->title . " a été créé.");
	}

	public function show($id)
	{
		$group = $this->groupRepository->getById($id);
		$groupUsers = DB::table('groupUsers')->where('idGroup', '=', $group->id)->get();
		$idFriends = User::getFriends();

		foreach($groupUsers as $groupUser) {
			foreach($idFriends as $idFriend) {
				if($groupUser->idUser == $idFriend) {
				$idFriendGroups[] = DB::table('groupUsers')->where('idUser', '=', $idFriend)->first();
			}
		}
			
		}
		foreach($idFriends as $idFriend) {
			foreach($idFriendGroups as $idFriendGroup) {
			if($idFriend == $idFriendGroup->idUser) {
				$friends[] = DB::table('users')->where('id', '=', $idFriend)->first();
			}
		}

		}

		return view('show',  compact('group', 'friends'));
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

		
		return redirect('group')->withOk("Le groupe " . $request->input('title') . " a été modifié.");
	}

	public function destroy($id)
	{
		$this->groupRepository->destroy($id);

		return redirect()->back();
	}
}
