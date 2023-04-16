<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Helpers\FileHelper;

class CountryRepository  extends BaseRepository
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

    public function find_by(Request $request, $relation = [], $columns = '*', $recursiveRel = [], $moreConditionForFirstLevel = [], $orderBy = [])
    {
        return $this->all($request->all(), null, null, $columns, [], [], $recursiveRel, false, [], $moreConditionForFirstLevel, '', $orderBy);
    }

    public function findByReportable(Request $request, $returnQuery)
    {

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
        if ($id) {
            $country = $this->model->where('id', $id)->first();
            $country->name = $request->name;
            $country->code = $request->code;
            if ($request->hasFile('logo')) {
                FileHelper::delete_picture($country->logo);
                $country->logo = FileHelper::upload_file('countries', $request->logo);
            }
            $country->save();
        } else {
            $this->model->name = $request->name;
            $this->model->code = $request->code;
            if ($request->hasFile('logo')) {

                $this->model->logo = FileHelper::upload_file('countries', $request->logo);
            }
            $country = $this->model->save();
        }
        return $country;
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
        return Country::class;
    }
}
