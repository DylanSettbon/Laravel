<?php
/**
 * Created by PhpStorm.
 * User: jeromebueno
 * Date: 07/06/2018
 * Time: 22:47
 */

namespace App\Http\Controllers;

use Auth;

class RelationController
{
    public function add($idReceived){
        $idSender = Auth::user()->id;

        if(\App\Relation::where('idSender',$idSender)->where('idReceived',$idReceived)->count() > 0 ||\App\Relation::where('idSender',$idReceived)->where('idReceived',$idSender)->count() > 0 ){
            return view('search', ['error' => 'Erreur']);
        }
        elseif ($idSender == $idReceived){
            return view('search', ['error' => 'Ajout de soi-même']);
        }
        else {
            \App\Relation::insert(
                array('idSender' => $idSender,
                    'idReceived' => $idReceived,
                    'status' => 0,
                    'created_at' => date('y-m-d H:i:s'))
            );
        }
    }
}