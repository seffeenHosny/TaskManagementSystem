<?php

namespace App\Repositories;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Models\City;

class CityRepository  extends BaseRepository
{
       /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

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
        return City::class;
    }


}
