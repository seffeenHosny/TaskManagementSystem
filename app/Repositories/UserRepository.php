<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class UserRepository  extends BaseRepository
{
       /**
     * @var array
     */
    protected $fieldSearchable = ['name'];

     /**
     * Use Search Criteria from request to find from model
     *
     * @param  Request $request
     * @return Collection
     */

    public function save(Request $request)
    {
        return  $this->create($request->all());
    }
    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }
    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function getOrganizers($request){
        $query= $this->model->where(['type'=>'organizer','status'=>'active']);
        if($request->has('user_id')){
            $query= $query->where('id',$request->user_id);
        }
        return $query->paginate(10);

    }
}
