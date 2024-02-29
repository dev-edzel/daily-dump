<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('POST')) {
            return [
                'title' => 'required|string|max:255|unique:posts',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
                'category_id' => 'required',
            ];
        } else {
            return [
                'title' => 'required|string|max:255|unique:posts',
                'description' => 'required|string',
                'author' => 'required|string|max:100',
                'category_id' => 'required|exists:categories,id',
            ];
        }
    }

    public function category_id(): int
    {
        return $this->input('category_id');
    }
}
