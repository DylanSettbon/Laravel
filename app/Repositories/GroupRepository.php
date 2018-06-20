<?php

namespace App\Repositories;

use App\Group;

class GroupRepository
{

    protected $group;

    public function __construct(Group $group)
	{
		$this->group = $group;
	}

	private function save(Group $group, Array $inputs)
	{
		$group->title = $inputs['title'];	

		$group->save();
	}

	public function getPaginate($n)
	{
		return $this->group->paginate($n);
	}

	public function store(Array $inputs)
	{
		$group = new $this->group;
		$group->title = $inputs['title'];		

		$this->save($group, $inputs);

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