<?php

namespace App\Interfaces;
interface BaseInterface {

    // function to get table data
    public function index();

    // function to store data
    public function store($request);

    // function to update data
    public function update($request , $model);

    // function to delete data
    public function delete($model);

}
