<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 10/06/2018
 * Time: 21:13
 */

namespace App\Http\Controllers;

use Auth;


class FriendsController
{
    public function showFriends()
    {
        $idWaitRelation = [];
        $relations = \App\Relation::where('status',1)->where('idReceived', Auth::user()->id)->orWhere('idSender', Auth::user()->id)->get();
        if (count($relations) == 0) {
            return view('friends', ['error' => 'Aucun amis']);
        } else {
            foreach ($relations as $relation) {
                if($relation->idSender != Auth::user()->id){$idWaitRelation[] = $relation->idSender;}
                if($relation->idReceived != Auth::user()->id){$idWaitRelation[] = $relation->idReceived;}
            }
            $friends = \App\User::whereIn('id', $idWaitRelation)->get();
            return view('friends', ['friends' => $friends]);
        }
    }

    public function getDemand(){
        $idWaitRelation = [];
        $relations = \App\Relation::where('idReceived',Auth::user()->id)->where('status',0)->get();
        if(count($relations) == 0){
            return view('addFriends',['error' => 'Aucune demande']);
        }
        else {
            foreach ($relations as $relation) {
                $idWaitRelation[] = $relation->idSender;
            }
            $users = \App\User::whereIn('id',$idWaitRelation)->get();
            return view('addFriends',['users' => $users]);
        }
    }

    public function acceptDemand($idAccepted){
        \App\Relation::where('idReceived',Auth::user()->id)->where('idSender',$idAccepted)->where('status',0)->update(array('status'=> 1));
        return view('addFriends');
    }
}