<?php

namespace App\Http\Requests;

use App\Models\Pertanyaan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class SiswaFormRequest extends FormRequest
{

    protected $pertanyaans;

    public function __construct()
    {
        $this->pertanyaans = Cache::remember('pertanyaans_current', 60 * 60 * 24, function () {
            return Pertanyaan::currentTahunAkademik()->get();
        });
    }

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
        $rules = [];
        foreach ($this->pertanyaans as $pertanyaan) {
            $rule = $pertanyaan->required ? 'required' : 'nullable';

            if ($pertanyaan->tipeInput === 'number') {
                $rule .= '|numeric';
            }

            $rules['pertanyaan_' . $pertanyaan->id] = $rule;
        }

        return $rules;
    }

    public function messages()
    {

        $messages = [];
        foreach ($this->pertanyaans as $pertanyaan) {
            $messages['pertanyaan_' . $pertanyaan->id . '.required'] = 'Pertanyaan ini tidak boleh kosong';
            if ($pertanyaan->tipeInput === 'number') {
                $messages['pertanyaan_' . $pertanyaan->id . '.numeric'] = 'Pertanyaan ini harus berupa angka';
            }
        }

        return $messages;
    }
}
