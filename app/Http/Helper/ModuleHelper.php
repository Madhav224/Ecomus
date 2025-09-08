<?php

use App\Models\Sidebar;


function DysidebarContentData()
{
    $sidebar = Sidebar::where('status', 'active')->orderBy('sidebar_sort_index')->get();


    $data = [];
    if ($sidebar) {
        $authuser = Auth::user();



        foreach ($sidebar as $value) {

            $childData = [];
            if ($value->parent_id === 0) {
                $permissionKey = ($value->link_type == 'dynamic_module')
                    ? $value->module_name
                    : $value->permissions_slug;

                if (!empty($permissionKey) && $authuser->hasRole(['staff']) && !$authuser->can($authuser->staff_role_id . '.' . $permissionKey . '.read')) {
                    continue;
                }

                $childsidebar = Sidebar::where('status', 'active')->where('parent_id', $value->id)->orderBy('sidebar_sort_index')->get();

                if ($childsidebar) {
                    foreach ($childsidebar as $childValue) {

                        $childpermissionKey = ($childValue->link_type == 'dynamic_module')
                            ? $childValue->module_name
                            : $childValue->permissions_slug;

                        if (!empty($childpermissionKey) && $authuser->hasRole(['staff']) && !$authuser->can($authuser->staff_role_id . '.' . $childpermissionKey . '.read')) {
                            continue;
                        }
                        $childData[] = [
                            'label' => $childValue->sidebar_label ?? null,
                            'link_type' => $childValue->link_type,
                            'link' => $childValue->sidebar_link ?? "",
                            'link_attribute' => $childValue->sidebar_link_attribute ?? "",
                            'icon' => $childValue->sidebar_icon ?? 'circle',
                            'roles' => json_decode($childValue->sidebar_roles) ?? [null],
                            // 'childData' => []
                        ];
                    }
                }

                if ($value->is_dropdown == 1 && empty($childData)) {
                    continue;
                }


                $data[] = [
                    'label' => $value->sidebar_label ?? null,
                    'link_type' => $value->link_type == "external_link" ? '1' : '0',
                    'link' => $value->sidebar_link ?? "",
                    'link_attribute' => $value->sidebar_link_attribute ?? "",
                    'icon' => $value->sidebar_icon ?? 'circle',
                    'roles' => json_decode($value->sidebar_roles) ?? [null],
                    'childData' => $childData
                ];
            }
        }
    }

    return $data;
}

function createHtmlForm($formArray = [], $fields_data = [])
{
    // dd($formArray,$fields_data);
    $html = '';
    if (!empty($formArray['fieldData'])) {


        $html .= '<div class="row">';
        $html .= '<input type="hidden" name="table_name" value="' . $formArray['table_name'] . '" />';
        $html .= '<input type="hidden" name="id" value="' . (isset($fields_data['id']) ? $fields_data['id'] : 0) . '" />';

        foreach ($formArray['fieldData'] as $key => $value) {
            $required = $value['required'] == 1 ? '<span class="text-danger"> *</span>' : '';

            if (in_array($value['fields'], ['repeater'])) {
                $fields_value = !empty($fields_data[$value['name']]) ? json_decode($fields_data[$value['name']]) : [];
                // dd($fields_data);
                $html .=
                    "<div class='repeater-container  col-12  '>
                    <div class='row'>
                   ";

                $placeholder = ucwords($value['placeholder']);

                $html .= '
                     <div class="col-12 ' . $value['layout_class'] . ' repeater-input mb-1" >
                    <label class="form-label" for="">' . ucwords($value['title']) . $required . '</label>
                                    <div class="input-group input-group-merge">
                                                    <input type="text"   class="form-control "
                                                        placeholder="' . $placeholder . '" name="' . $value['name'] . '[]" aria-describedby="' . $value['title'] . '" value="' . (!empty($fields_value) ? $fields_value[0] : null) . '">
                                                      <span class="input-group-text text-dark add-repeater"
                                                         type="button" >
                                                            <i data-feather="plus"></i>
                                                    </span>
                                    </div>
                                                <small class="error ' . $value['name'] . '-error"></small>

                    </div>';


                if (!empty($fields_value)) {
                    unset($fields_value[0]);
                    foreach ($fields_value as $repeaterkey => $repeatervalue) {
                        $html .= '
                        <div class="col-12 ' . $value['layout_class'] . ' repeater-input mb-1" >
                       <label class="form-label" for="">' . ucwords($value['title']) . $required . '</label>
                                       <div class="input-group input-group-merge">
                                                       <input type="text"   class="form-control "
                                                           placeholder="' . $placeholder . '" name="' . $value['name'] . '[]" aria-describedby="' . $value['title'] . '" value="' . $repeatervalue . '">
                                                         <span class="input-group-text text-dark remove-repeater"
                                                            type="button" >
                                                               <i data-feather="x"></i>
                                                       </span>
                                       </div>
                                                   <small class="error ' . $value['name'] . '-error"></small>

                       </div>';
                    }
                }

                $html .=
                    "</div>
                    </div>";
            } else if (in_array($value['fields'], ['container_repeater'])) {

                $container_value = !empty($fields_data[$value['name']]) ? json_decode($fields_data[$value['name']], true) : [];

                $repeat_count = !empty($container_value) ? count($container_value) : 1;



                $html .=
                    "<div class='" . $value['layout_class'] . " col-12 '>
                    <div class='fields-repeater-container  '>
                    <label class='form-label' for='" . $value['name'] . "'>" . ucwords($value['title']) . "</label>

                   ";
                $repeater_fields = $value['repeater_fields'];

                if (!empty($repeater_fields)) {
                    for ($index = 0; $index < $repeat_count; $index++) {
                        $rowValues = !empty($container_value[$index]) ? $container_value[$index] : [];

                        $html .= "
                        <div class=' container-repeater position-relative col-lg-12 col-md-12 col-sm-12 col-12  mb-2  rounded p-1' >";
                        $html .= $index != 0 ? "<span class='remove-container-repeater border-danger text-light bg-light-danger'><i data-feather='x'></i></span>" : '';
                        $html .= "<div class='row'>
                        ";


                        foreach ($repeater_fields as $fieldkey => $fieldvalue) {
                            $html .= "<div class='" . $fieldvalue->layout . " col-12 ' >
                         <label class='form-label' for='" . $fieldvalue->name . "'>" . ucwords($fieldvalue->title) . "</label>";



                            $placeholder = ucwords($fieldvalue->placeholder);
                            $ContainerfieldName = $value['name'] . "[$index][" . $fieldvalue->name . "]";
                            $ContainerfieldValue = isset($rowValues[$fieldvalue->name]) ? $rowValues[$fieldvalue->name] : '';


                            if (in_array($fieldvalue->field, ['text', 'email', 'number', 'date', 'time', 'datetime-local', 'color'])) {

                                $html .=
                                    "<input type='" . $fieldvalue->field . "' class='form-control' name='" . $ContainerfieldName . "' id='" . $fieldvalue->name . "'   placeholder='" . $placeholder . "'  aria-describedby='" . $fieldvalue->title . "' tabindex='" . ($fieldkey + 1) . "' value='" . $ContainerfieldValue . "'/>";
                            }

                            if (in_array($fieldvalue->field, ['password'])) {
                                $html .=
                                    '<div class="input-group input-group-merge form-password-toggle">
                                    <input class="form-control  form-control-merge" placeholder="' . $placeholder . '"  type="' . $fieldvalue->field . '" name="' . $ContainerfieldName . '" id="' . $fieldvalue->name . '"  aria-describedby="' . $fieldvalue->name . '" tabindex="' . ($fieldkey + 1) . '" value="' . $ContainerfieldValue . '"/>
                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                </div>';
                            }

                            if ($fieldvalue->field == 'textarea') {
                                $html .=
                                    '<textarea class="form-control"  placeholder="' . $placeholder . '"  type="' . $fieldvalue->field . '" name="' . $ContainerfieldName . '" id="' . $fieldvalue->name . '"  aria-describedby="' . $fieldvalue->field . '" >' . $ContainerfieldValue . '</textarea>';
                            }

                            $html .= "</div>";
                        }
                        $html .= "
                        </div>
                        </div>
                        ";
                    }
                }

                $html .=
                    "
                   </div>
                   <div class='mb-1'>

                   <button type='button' class='btn btn-outline-primary  AddContainer-" . $value['name'] . "'><i data-feather='plus'></i> Add " . ucwords($value['title']) . "</button>
                    </div>
                    </div>
                   ";
            } else {
                $html .=
                    "<div class='" . ($value['fields'] != 'text_editor' ? 'mb-1' : '') . " col-12 " . $value['layout_class'] . "' style='margin-bottom:" . ($value['fields'] == 'text_editor' ? "130px" : '') . ";'>
					<label class='form-label' for='" . $value['name'] . "'>" . ucwords($value['title']) . $required . "</label>";

                $fields_value = $fields_data[$value['name']] ?? $value['default_value'];
                $placeholder = ucwords($value['placeholder']);

                if (in_array($value['fields'], ['text', 'email', 'number', 'date', 'time', 'datetime-local', 'color'])) {

                    $html .=
                        "<input type='" . $value['fields'] . "' class='form-control' name='" . $value['name'] . "' id='" . $value['name'] . "' value='" . $fields_value . "'  placeholder='" . $placeholder . "'  aria-describedby='" . $value['title'] . "' tabindex='" . ($key + 1) . "' />";
                }

                if (in_array($value['fields'], ['single_file', 'multiple_file'])) {
                    $multiple = in_array($value['fields'], ['multiple_file']) ? "multiple" : "";

                    $name = in_array($value['fields'], ['multiple_file']) ? $value['name'] . "[]" : $value['name'];

                    $value['fields'] = 'file';
                    $html .=
                        "<input $multiple  type='" . $value['fields'] . "' class='form-control " . $value['name'] . "' name='" . $name . "'   placeholder='" . $placeholder . "' accept='" . $value['file_type'] . "' id='" . $value['name'] . "'  aria-describedby='" . $value['title'] . "'   tabindex='" . ($key + 1) . "'   />";


                    if (!empty($fields_value)) {
                        $img_src = json_decode($fields_value, true);

                        if (!empty($img_src)) { {

                                $html .= "<div class='mt-1 overflow-auto d-flex flex-row flex-wrap module_file_preview' style='max-height:250px; '>";
                                foreach ($img_src as $img) {
                                    $html .= '<div  class="my-1 image-container" style="position: relative;">';

                                    $path = asset(!empty($img) && file_exists(public_path($img)) ? $img : "module_uploads/no_image.jpg");
                                    $html .= '<img src="' . $path . '" alt="' . $path . '" class="img-thumbnail ms-1 "  style="width: 106px; height: 100px;" />';
                                    $html .= ' <span class="text-danger remove_img_btn  text-nowrap "
                                           \ data-field="' . $value['name'] . '" data-tablename="' . $formArray['table_name'] . '" data-id="' . $fields_data['id'] . '" data-img="' . $img . '">
                                                <i data-feather="x"></i>
                                                </span>';


                                    $html .= '</div>';
                                }
                                $html .= "</div>";
                            }
                        }
                    }
                }

                if (in_array($value['fields'], ['password'])) {
                    $html .=
                        '<div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control  form-control-merge" placeholder="' . $placeholder . '" value="' . $fields_value . '"  type="' . $value['fields'] . '" name="' . $value['name'] . '" id="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>';
                }

                if (in_array($value['fields'], ['radio', 'checkbox'])) {
                    $html .=
                        '<div class="d-flex flex-wrap gap-1">'; //demo-inline-spacing-s
                    if (!empty($value['data'])) {
                        foreach ($value['data'] as $childKey => $childValue) {


                            if ($value['fields'] === 'checkbox') {
                                $input_data = json_decode($fields_value, true);
                                $checked = !empty($input_data) && in_array($childValue['value'], $input_data) ? 'checked' : '';
                            } else {
                                if (!empty($fields_data[$value['name']])) {
                                    $checked = !empty($fields_value) && $fields_value == $childValue['value'] ? 'checked' : '';
                                } else {
                                    $def_value = json_decode($value['default_value'], true);
                                    $checked = !empty($def_value) && $childValue['value'] == $def_value[0] ? 'checked' : '';
                                }
                            }
                            $arr = in_array($value['fields'], ['checkbox']) ? '[]' : '';
                            $html .=
                                '<div class="text-capitalize form-check form-check-primary ">
                                    <input type="' . $value['fields'] . '"   name="' . $value['name'] . $arr . '" value="' . $childValue['value'] . '" class="form-check-input"  id="' . ($value['name'] . $childKey) . '"  ' . $checked . '/>
                                    <label class="form-check-label" for="' . ($value['name'] . $childKey) . '">' . $childValue['label'] . '</label>
                                </div>';
                        }
                    }
                    $html .= '</div>';
                }

                if (in_array($value['fields'], ['select', 'multiple_select'])) {
                    $arr = in_array($value['fields'], ['multiple_select']);

                    $html .= '<select class="' . ($arr ? "select2" : "") . ' form-select select_class" id="' . $value['name'] . '" name="' . $value['name'] . ($arr ? "[]" : "") . '"  ' . ($arr ? "multiple" : "") . '>
									' . (!$arr ? "<option value=''>select</option>" : "") . '';

                    if (!empty($value['data'])) {

                        foreach ($value['data'] as $childKey => $childValue) {
                            $Selvalues = json_decode($fields_value, true);
                            if ($value['fields'] === 'multiple_select') {
                                $selected = !empty($Selvalues) && in_array($childValue['value'], $Selvalues) ? 'selected' : '';
                            } else {
                                if (!empty($fields_data[$value['name']])) {
                                    $selected = !empty($fields_value) && $fields_value == $childValue['value'] ? 'selected' : '';
                                } else {
                                    $selected = !empty($Selvalues) && in_array($childValue['value'], $Selvalues) ? 'selected' : '';
                                }
                            }
                            $html .= '<option value="' . strtolower($childValue['value']) . '" ' . $selected . '>' . ucfirst($childValue['label']) . '</option>';
                        }
                    }
                    $html .= '</select>';
                }

                if (in_array($value['fields'], ['badge'])) {
                    $arr = in_array($value['fields'], ['multiple_select']);

                    $html .= '<select class=" form-select " id="' . $value['name'] . '" name="' . $value['name'] . '" >
									<option value="">select</option>';
                    if (!empty($value['data'])) {
                        foreach ($value['data'] as $childKey => $childValue) {
                            $Selvalues = json_decode($fields_value, true);
                            if (!empty($fields_data[$value['name']])) {
                                $selected = !empty($fields_value) && $fields_value == $childValue['value'] ? 'selected' : '';
                            } else {
                                $selected = !empty($Selvalues) && in_array($childValue['value'], $Selvalues) ? 'selected' : '';
                            }
                            $html .= '<option value="' . strtolower($childValue['value']) . '" ' . $selected . '>' . ucfirst($childValue['label']) . '</option>';
                        }
                    }
                    $html .= '</select>';
                }

                if ($value['fields'] == 'textarea') {
                    $html .=
                        '<textarea class="form-control"  placeholder="' . $placeholder . '"  type="' . $value['fields'] . '" name="' . $value['name'] . '" id="' . $value['name'] . '"  aria-describedby="' . $value['fields'] . '" >' . $fields_value . '</textarea>';
                }

                if ($value['fields'] == 'text_editor') {
                    $html .= '<textarea class="form-control quill-editor "  placeholder="' . $placeholder . '"  type="' . $value['fields'] . '" name="' . $value['name'] . '" id="' . $value['name'] . '"  aria-describedby="' . $value['fields'] . '" >' . $fields_value . '</textarea>';
                }

                $html .= '<small class="error ' . $value['name'] . '-error"></small>';
                $html .=
                    "</div>";
            }
        }

        $html .= '</div>';
    }

    return $html;
}
