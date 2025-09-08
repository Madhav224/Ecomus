<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreModuleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Change to `true` if every user is allowed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'module_name' => 'required|unique:module,module_name,' . $this->module_id,
            'form_type' => 'required',
            'data.*.title' => 'required|string|max:255',
            'data.*.name' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $reservedNames = ['id', 'updated_at', 'created_at', 'status','slug'];
                    if (in_array(strtolower($value), $reservedNames)) {
                        $fail("This field cannot be one of the reserved names.");
                    }

                    $names = collect($this->input('data'))->pluck('name');
                    $duplicates = $names->filter(fn($name) => strtolower($name) === strtolower($value));

                    if ($duplicates->count() > 1) {
                        $fail("This field must be unique. Please ensure that each name is distinct.");
                    }
                },
            ],
            'data.*.fields' => 'required',
            'data.*.is_relational' => function ($attribute, $value, $fail) {
                foreach ($this->input('data', []) as $index => $item) {
                    if (in_array($item['fields'] ?? '', ['select', 'multiple_select']) && empty($item['is_relational'] ?? null)) {
                        $fail("The data.$index.is_relational field is required when fields is select or multiple_select.");
                    }
                    if (($item['is_relational'] ?? '') === 'dynamic_data') {
                        foreach (['relational_table', 'relational_table_label_field', 'relational_table_value_field'] as $field) {
                            if (empty($item[$field] ?? null)) {
                                $fail("The data.$index.$field field is required when is_relational is dynamic_data.");
                            }
                        }
                    }
                }
            },
            'data.*.relational_table' => 'required_if:data.*.is_relational,dynamic_data',
            'data.*.relational_table_label_field' => 'required_if:data.*.is_relational,dynamic_data',
            'data.*.relational_table_value_field' => 'required_if:data.*.is_relational,dynamic_data',
            'data.*.options.*' => 'required_if:data.*.is_relational,static_data|required_if:data.*.fields,checkbox|required_if:data.*.fields,badge|required_if:data.*.fields,radio',
            'data.*.file_types' => 'required_if:data.*.fields,single_file,multiple_file',
            'data.*.repeater_fields' => 'required_if:data.*.fields,container_repeater',
            'data.*.repeater.*.field' => 'required_if:data.*.fields,container_repeater',
            'data.*.repeater.*.title' => 'required_if:data.*.fields,container_repeater',
            'data.*.repeater.*.name' => [
                function ($attribute, $value, $fail) {
                    $reservedNames = ['id', 'updated_at', 'created_at', 'status','slug'];

                    preg_match('/data\.(\d+)\.repeater\.(\d+)\.name/', $attribute, $matches);

                    if (isset($matches[1])) {
                        $dataIndex = $matches[1];
                        $fieldsValue = $this->input("data.$dataIndex.fields");

                        if ($fieldsValue !== 'container_repeater') {
                            return;
                        }

                        if (empty($value)) {
                            $fail("The name field is required.");
                        }

                        if (strlen($value) > 255) {
                            $fail("This field must not exceed 255 characters.");
                        }

                        if (in_array(strtolower($value), $reservedNames)) {
                            $fail("This field cannot use a reserved name (id, updated_at, created_at, status).");
                        }

                        $repeaterNames = collect($this->input("data.$dataIndex.repeater"))->pluck('name');

                        if ($repeaterNames->filter(fn($name) => strtolower($name) === strtolower($value))->count() > 1) {
                            $fail("This field must be unique within this repeater group.");
                        }
                    }
                },
            ],
        ];
    }

    /**
     * Customize the error response.
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $customErrors = [];

        foreach ($errors as $key => $messages) {
            if (str_starts_with($key, 'data.')) {
                $parts = explode('.', $key);

                if (in_array('repeater', $parts)) {
                    $newKey = '';
                    foreach ($parts as $index => $part) {
                        if ($index !== 0) {
                            $newKey .= is_numeric($part) ? $part : $part;
                        }
                    }
                    $customErrors[$newKey] = $messages;
                } else {
                    if (isset($parts[1]) && isset($parts[2])) {
                        $index = $parts[1];
                        $field = $parts[2];
                        $newKey = $index . $field;
                        $customErrors[$newKey] = $messages;
                    } else {
                        $customErrors[$key] = $messages;
                    }
                }
            } else {
                $customErrors[$key] = $messages;
            }
        }

        throw new HttpResponseException(response()->json(['errors' => $customErrors], 422));
    }

    /**
     * Get custom validation messages for specific fields.
     */
    public function messages(): array
    {
        return [
            'module_name.required' => 'The module name is required.',
            'module_name.unique' => 'The module name must be unique.',
            'form_type.required' => 'The form type is required.',
            'data.*.title.required' => 'The title field is required.',
            'data.*.name.required' => 'The name field is required.',
            'data.*.name.max' => 'The name field must not exceed 255 characters.',
            'data.*.fields.required' => 'The fields field is required.',
            'data.*.is_relational.required_if' => 'The is_relational field is required when fields is select or multiple_select.',
            'data.*.relational_table.required_if' => 'The relational table is required.',
            'data.*.relational_table_label_field.required_if' => 'The relational table label field is required.',
            'data.*.relational_table_value_field.required_if' => 'The relational table value field is required.',
            'data.*.options.*.required_if' => 'The Options are required.',
            'data.*.file_types.required_if' => 'File types are required when fields is single_file or multiple_file.',
            'data.*.repeater_fields.required_if' => 'Repeater fields are required when fields is container_repeater.',
            'data.*.repeater.*.field.required_if' => 'The fields field is required.',
            'data.*.repeater.*.title.required_if' => 'The title field is required.',
            'data.*.repeater.*.name.required_if' => 'The name field is required.',
        ];
    }
}
