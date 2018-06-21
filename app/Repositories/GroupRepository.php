<?php

namespace App\Repositories;

use App\Group;
use App\GroupUsers;
use App\User;
use DB;

class GroupRepository
{

    protected $group;
    protected $groupusers;



    public function __construct(Group $group, Groupusers $groupusers)
	{
		$this->group = $group;
		$this->groupusers = $groupusers;
	}

	private function save(Group $group, Groupusers $groupusers, Array $inputs)
	{
		$group->title = $inputs['title'];
		$idFriends = User::getFriends();

		$group->save();

		foreach($inputs['friends'] as $friend) {
			foreach($idFriends as $idFriend) {
				//dd('idFriends : ' .$idFriend. ' Friends : ' .$friend);
				if($idFriend == $friend) {
					$groupusers->idUser = $idFriend;
					$groupusers->idGroup = $group->id;
					DB::table('groupUsers')->insert(['idUser' => $idFriend, 'idGroup' => $group->id]);
				}
			}
		}
	}

	public function getPaginate($n)
	{
		return $this->group->paginate($n);
	}

	public function store(Array $inputs)
	{
		$idFriends = User::getFriends();

		$group = new $this->group;
		$groupusers = new $this->groupusers;

		$group->title = $inputs['title'];	

		foreach($inputs['friends'] as $friend) {
			foreach($idFriends as $idFriend) {
				if($idFriend == $friend)
					$groupusers->idUser = $idFriend;
			}
		}

		$this->save($group, $groupusers, $inputs);
		return $group;
	}

	public function getById($id)
	{
		return $this->group->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->save($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}