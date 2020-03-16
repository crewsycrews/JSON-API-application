<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiRequest extends FormRequest
{
    /**
     * We want to validate data from json body of the API request when possible
     *
     * @return void
     */
    public function validationData()
    {
        return count($this->json()->all()) ? $this->json()->all() : $this->all();
    }
}
