<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\API\ResponseController;

class AuthFormRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Custom response message.
     */
    public function failedValidation(Validator $validator): JsonResponse
    {
        $response = ResponseController::response('Validation error', $validator->errors()->all()[0], Response::HTTP_BAD_REQUEST);

        throw new ValidationException($validator, $response);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->routeIs('login')) {
            return [
                'email' => 'required|email',
                'password' => 'required|min:6|max:25',
            ];
        }

        return [];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.unique' => 'Email is not available',
            'password.required' => 'Your password is required',
            'password.min' => 'Password must be minimum of 6 characters',
            'password.max' => 'Password must be maximum of 25 characters',
        ];
    }
}
