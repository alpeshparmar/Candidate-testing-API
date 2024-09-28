<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change this as per your authorization logic
    }

    public function rules()
    {
        return [
            'author_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'release_date' => 'required|date',
            'description' => 'required|string',
            'isbn' => 'required|string|max:20',
            'format' => 'required|string|max:50',
            'number_of_pages' => 'required|integer|min:1',
        ];
    }
}
