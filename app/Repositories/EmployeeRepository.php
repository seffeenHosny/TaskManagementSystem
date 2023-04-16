<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\FileHelper;
class EmployeeRepository  extends BaseRepository
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

    public function find_by(Request $request, $relation = [], $columns = '*', $recursiveRel = [],$moreConditionForFirstLevel = [], $orderBy = [])
    {
        return $this->all($request->all(), null, null, $columns, [], [], $recursiveRel, false, [], $moreConditionForFirstLevel, '', $orderBy);

    }

    public function findByReportable(Request $request, $returnQuery){

        return $this->builder($request->all())->return($returnQuery);
    }

        /**
     * save [Use save data into Model]
     *
     * @param  Request $request
     * @param  Int $id
     * @return Boolean
     */
    public function save(Request $request, int $id = null)
    {
           // check weather is there id or not
        if($id){
            $employee=$this->model->where('id',$id)->first();
            $obj=$employee;
            if($request->has('image')){
                $image = FileHelper::update_file('employees' , $request->image , $obj->image);
                $obj->image = $image;
            }
        }else{
            $obj=$this->model;
            if($request->has('image')){
                $image = FileHelper::upload_file('employees' , $request->image);
                $obj->image = $image;
            }
            $obj->password=Hash::make($request->password);
            $obj->type='admin';
            $obj->active=1;
        }
            $obj->name=$request->name;
            $obj->email=$request->email;
            $obj->phone=$request->phone;
            $obj->save();
        return $obj;
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

    public function block($id){
        $employee=$this->model->where('id',$id)->first();
        $employee->active = 0 ;
        $employee->save();
        return true;
    }

    public function unblock($id){
        $employee=$this->model->where('id',$id)->first();
        $employee->active = 1;
        $employee->save();
        return true;
    }

    public function changePassword($id, $old_password, $new_password)
    {
        $item = $this->model->where('id', $id)->first();
        if (Hash::check($old_password, $item->password)) {
            $this->model->where('id', $id)->update(['password' => bcrypt($new_password)]);
            return true;
        } else {
            return false;
        }
    }

    public function updateProfile($request){
        $user = $this->model->where('id', auth()->user()->id)->first();
        if(Hash::check($request->old_password, $user->password)) {
            $data = $request->except('_token' , 'password' , 'old_password' , 'password_confirmation');
            if($request->has('password') && $request->password != null){
                $data['password'] = bcrypt($request->password);
            }
            if($request->has('image')){
                $image = FileHelper::update_file('employees' , $request->image , $user->image);
                $data['image'] = $image;
            }
            $user->update($data);
            return 'true';
        } else {
            return 'wrong_old_password';
        }
    }

    public function updateOrganizerProfile($request){
        $user = $this->model->where('id', auth()->user()->id)->first();
        if($request->has('image_path')){
            $image = FileHelper::update_file('' , $request->image , $user->image);
            $request->request->add(['image'=>$image]);
        }
        $user=$user->update($request->all());
        if($user){
            return true;
        } else {
            return false;
        }
    }
        /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }


}
