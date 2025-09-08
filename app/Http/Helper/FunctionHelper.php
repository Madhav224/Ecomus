<?php

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;
use ElephantIO\Client;
use Illuminate\Support\Facades\DB;



function demoTest($name = 'user')
{
    return $name;
}

#function for convert the value in encrypt mode
function encrypt_to($value = NULL, $type = NULL)
{
    $new_value = trim($value);
    $value = encryptvalue($new_value);
    return trim($value);
}

#function for convert the value in decrypt mode
function decrypt_to($value = NULL, $type = NULL)
{
    if (empty($value))
        return NULL;

    $new_value = decryptvalue($value);
    return trim($new_value);
}

#function for encrypt the passing paramter
function encryptvalue($string = NULL)
{
    $key = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }
    return urlencode(base64_encode($result));
}

#function for decrypt the passing paramter
function decryptvalue($string = NULL)
{
    $key = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

    $result = '';
    $string = base64_decode(urldecode($string));
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}

#function for create html form content ---------------
function createFormHtmlContent($formArray = [])
{
    $html = '';
    if (!empty($formArray['name']) && !empty($formArray['fieldData'])) {
        $html .=
            '<form class="row" id="' . $formArray['name'] . '" action="' . $formArray['action'] . '" method="' . (!empty($formArray['method']) ? $formArray['method'] : 'get') . '">';

        foreach ($formArray['fieldData'] as $key => $value) {
            $element_extra_classes = (!empty($value['element_extra_classes']) ? $value['element_extra_classes'] : '');
            $ext_attr = (!empty($value['element_extra_attributes']) ? $value['element_extra_attributes'] : '');

            if ($value['tag'] == 'button') {
                $html .= '
                <div class="col-12 col-md-' . (!empty($value['grid']) ? $value['grid'] : '12') . ' mt-2   ' . (!empty($value['outer_div_classes']) ? $value['outer_div_classes'] : '') . ' ">
                <a href="javascript:void(0);" id="' . $value['name'] . '" class="btn btn-outline-primary  w-100 waves-effect waves-float waves-light ' . (!empty($value['extra-class']) ? $value['extra-class'] : '') . ' ' . $element_extra_classes . '" name="' . $value['name'] . '" >' . $value['label'] . '</a>
                </div>
                ';
                continue;
            }

            if ($value['tag'] == 'submit') {
                $html .=
                    '<div class="col-12 col-md-' . (!empty($value['grid']) ? $value['grid'] : '12') . ' mt-2 ">
                    <button type="submit" class="btn btn-outline-primary w-100 text-capitalize  ' . $element_extra_classes . '" tabindex="4">' . (!empty($value['label']) ? $value['label'] : 'save') .
                    '</button></div>';
                continue;
            }

            if ($value['tag'] == 'input' && in_array($value['type'], ['hidden'])) {

                $html .=
                    '<input class="' . $element_extra_classes . '" value="' . ($value['value'] ?? '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '" ' . $ext_attr . ' aria-describedby="' . $value['name'] . '" />';
                continue;
            }

            $html .=
                '<div class="col-12 col-md-' . (!empty($value['grid']) ? $value['grid'] : '12') . ' ' . (!empty($value['outer_div_classes']) ? $value['outer_div_classes'] : '') . '" style="margin-bottom: ' . ($element_extra_classes == "quill-editor" ? "9rem" : "1rem") . ';">
            <label class="form-label
                <label class="form-label" for="#">' . ucwords($value['label']) . '</label>';

            $value['placeholder'] = ucwords(!empty($value['placeholder']) ? $value['placeholder'] : $value['label']);

            if ($value['tag'] == 'input') {

                if (in_array($value['type'], ['text', 'email', 'number', 'button', 'reset', 'color'])) {
                    $html .=
                        '<input class="form-control ' . $element_extra_classes . '" placeholder="' . $value['placeholder'] . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" />';
                }

                // if(in_array($value['type'],['file'])){
                //     $arrfile = isset($value['is_multiple']) && $value['is_multiple'] == true ? '[]': '';
                //     $html .=
                //         '<input class="form-control ' . $element_extra_classes . '" placeholder="' . $value['placeholder'] . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] .$arrfile . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" '.$ext_attr.' />
                //         <div id="._preview" class="file-upload-preview mt-2">
                //             <div class="preview-image-container">

                //             </div>
                //         </div>';
                // }

                if (in_array($value['type'], ['file'])) {
                    $arrfile = isset($value['is_multiple']) && $value['is_multiple'] == true ? '[]' : '';
                    $inputName = $value['name'];
                    $previewId = $inputName . '_preview';

                    $html .=
                        '<input class="form-control ' . $element_extra_classes . '" placeholder="' . $value['placeholder'] . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $inputName . '" type="' . $value['type'] . '" name="' . $inputName . $arrfile . '"  aria-describedby="' . $inputName . '" tabindex="' . ($key + 1) . '" ' . $ext_attr . ' />
                        <div id="' . $previewId . '" class="file-upload-preview mt-2 ' . $previewId . '">
                            <div class="preview-image-container">

                            </div>
                        </div>';
                }

                if (in_array($value['type'], ['password'])) {
                    $html .=
                        '<div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control ' . $element_extra_classes . '" placeholder="' . $value['placeholder'] . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>';
                }
                if (in_array($value['type'], ['date', 'time', 'datetime-local'])) {
                    $html .=
                        '<input class="form-control  ' . $element_extra_classes . '"  placeholder="' . $value['placeholder'] . '"  value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  '.$ext_attr.' tabindex="' . ($key + 1) . '" />';
                }
                if (in_array($value['type'], ['radio', 'checkbox'])) {
                    $html .=
                        '<div class="demo-inline-spacing-s d-flex flex-wrap">';
                    if (!empty($value['data'])) {
                        $checkarr = ($value['type'] == 'checkbox' ? '[]' : '');
                        foreach ($value['data'] as $childKey => $childValue) {

                            $checked = (!empty($value['value']) && $value['value'] == $childValue['value'] ? 'checked' : '');
                            $html .=
                                '<div class="demo-inline-spacing-s text-capitalize form-check form-check-primary ms-1">
                                    <input type="' . $value['type'] . '" ' . $ext_attr . '  placeholder="' . $value['placeholder'] . '"  name="' . $value['name'] . $checkarr . '" value="' . $childValue['value'] . '" class="form-check-input  ' . $element_extra_classes . '" id="' . $value['name'] . $childKey . '" ' . $checked . '/>
                                    <label class="form-check-label fs-09rem" for="' . $value['name'] . $childKey . '">' . $childValue['label'] . '</label>
                                </div>';
                        }
                    }
                    $html .= '</div>';
                }
            }
            if ($value['tag'] == 'select') {
                $html .= '<select class="form-select ' . $element_extra_classes . '" ' . $ext_attr . '  name="' . $value['name'] . '" id="' . $value['name'] . '">
                                ';

                $html .= $ext_attr != "multiple" ? '<option value="">select</option>' : '';
                if (!empty($value['data'])) {
                    foreach ($value['data'] as $childKey => $childValue) {
                        $html .= '<option value="' . $childValue['value'] . '">' . $childValue['label'] . '</option>';
                    }
                }
                $html .= '</select>';
            }
            if ($value['tag'] == 'select2') {
                $html .= '<select class="form-select select2' . $element_extra_classes . '" ' . $ext_attr . '  name="' . $value['name'] . '[]" id="' . $value['name'] . '" multiple>
                                ';

                if (!empty($value['data'])) {
                    foreach ($value['data'] as $childKey => $childValue) {
                        $html .= '<option value="' . $childValue['value'] . '">' . $childValue['label'] . '</option>';
                    }
                }
                $html .= '</select>';
            }
            if ($value['tag'] == 'textarea') {
                $html .=
                    '<textarea class="form-control ' . $element_extra_classes . '" ' . $ext_attr . ' placeholder="' . ucwords(!empty($value['placeholder']) ? $value['placeholder'] : $value['name']) . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" >' . (!empty($value['value']) ? $value['value'] : '') . '</textarea>';
            }

            $html .=
                '<small class="error ' . $value['name'] . '-error"></small>
            </div>';
        }
        if (empty($formArray['no_submit'])) {
            $html .=
                '<div class="modal-footer pb-0"><div class="col-12 col-md-' . (!empty($formArray['btnGrid']) ? $formArray['btnGrid'] : '12') . ' ">
                    <button type="submit" class="btn btn-primary w-100 text-capitalize" tabindex="4">' . (!empty($formArray['submit']) ? $formArray['submit'] : 'save') . '</button>
                </div></div>';
        }


        $html .=
            '</form>';
    }
    return $html;
}
#---------------

#function for create html form content ---------------
function createDatatableFormFilter($formArray = [])
{
    $html = '';
    if (!empty($formArray['name'])) {
        $html .=
            '<form class="row datatable_paginate card-body pb-75" id="' . $formArray['name'] . '" action="' . $formArray['action'] . '" method="' . (!empty($formArray['method']) ? $formArray['method'] : 'get') . '">';
        if (!empty($formArray['fieldData'])) {
            $html .= '<div class="offcanvas offcanvas-end Filteroffcanvas" tabindex="-1" aria-labelledby="FilteroffcanvasLabel">
                    <div class="offcanvas-header px-0">
                        <h5 id="FilteroffcanvasLabel" class="offcanvas-title">Filter</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-0 "><div class="row">';
            foreach ($formArray['fieldData'] as $key => $value) {
                if (!empty($value)) {



                    if (!empty($value['roles']) && (!Auth::user()->hasRole($value['roles'])))
                        continue;

                    $element_extra_classes = (!empty($value['element_extra_classes']) ? $value['element_extra_classes'] : '');
                    $ext_attr = (!empty($value['element_extra_attributes']) ? $value['element_extra_attributes'] : '');

                    if ($value['tag'] == 'button') {
                        $html .= '
                            <div class="col col-md-' . (!empty($value['grid']) ? $value['grid'] : '12') . ' mt-2   ' . (!empty($value['outer_div_classes']) ? $value['outer_div_classes'] : '') . ' ">
                            <a href="javascript:void(0);"  id="' . $value['name'] . '" class="btn btn-outline-primary waves-effect waves-float waves-light ' . (!empty($value['extra-class']) ? $value['extra-class'] : '') . ' ' . $element_extra_classes . '" name="' . $value['name'] . '" >' . $value['label'] . '</a>
                            </div>
                            ';
                        continue;
                    }
                    if (in_array($value['type'], ['hidden'])) {

                        $html .=
                            '<input class="' . $element_extra_classes . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" />';
                        continue;
                    }

                    $html .=
                        '<div class="col col-md-' . (!empty($value['grid']) ? $value['grid'] : '12') . ' ' . (!empty($value['outer_div_classes']) ? $value['outer_div_classes'] : '') . '" style="margin-bottom: 1rem">
                    <label class="form-label" for="login-email">' . $value['label'] . '</label>';

                    $value['placeholder'] = ucwords(!empty($value['placeholder']) ? $value['placeholder'] : $value['label']);
                    if ($value['tag'] == 'select') {
                        $html .= '<select class="form-select ' . $element_extra_classes . '" ' . $ext_attr . ' name="' . $value['name'] . '" id="' . $value['name'] . '" tabindex="' . ($key + 1) . '">
                                    <option value="">select</option>';
                        if (!empty($value['data'])) {
                            foreach ($value['data'] as $childKey => $childValue) {
                                $html .= '<option value="' . $childValue['value'] . '">' . $childValue['label'] . '</option>';
                            }
                        }
                        $html .= '</select>';
                    }

                    if ($value['tag'] == 'input') {
                        if (in_array($value['type'], ['text', 'email', 'number', 'button'])) {
                            $html .=
                                '<input class="form-control ' . $element_extra_classes . '" placeholder="' . $value['placeholder'] . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" />';
                        }
                        if (in_array($value['type'], ['reset'])) {
                            $html .=
                                '<input class="form-control ' . $element_extra_classes . '"  value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" />';
                        }

                        if (in_array($value['type'], ['password'])) {
                            $html .=
                                '<div class="input-group input-group-merge form-password-toggle">
                                <input class="form-control  form-control-merge  ' . $element_extra_classes . '" placeholder="' . $value['placeholder'] . '" value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>';
                        }
                        if (in_array($value['type'], ['date', 'time', 'datetime-local'])) {
                            $html .=
                                '<input class="form-control  ' . $element_extra_classes . '"  placeholder="' . $value['placeholder'] . '"  value="' . (!empty($value['value']) ? $value['value'] : '') . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  tabindex="' . ($key + 1) . '" />';
                        }
                        if (in_array($value['type'], ['radio', 'checkbox'])) {
                            $html .=
                                '<div class="demo-inline-spacing-s d-flex flex-wrap">';
                            if (!empty($value['data'])) {
                                foreach ($value['data'] as $childKey => $childValue) {
                                    $checked = (!empty($value['value']) && $value['value'] == $childValue['value'] ? 'checked' : '');

                                    $html .=
                                        '<div class=" text-capitalize form-check form-check-primary mt-' . ($childKey > 0 ? '0' : '0') . ' ms-1">
                                        <input type="' . $value['type'] . '"  placeholder="' . $value['placeholder'] . '"  name="' . $value['name'] . '" value="' . $childValue['value'] . '" class="form-check-input  ' . $element_extra_classes . '" id="' . $value['name'] . $childKey . '" ' . $checked . ' />
                                        <label class="form-check-label fs-09rem"  for="' . $value['name'] . $childKey . '">' . $childValue['label'] . '</label>
                                    </div>';
                                }
                            }
                            $html .= '</div>';
                        }
                    }

                    if ($value['tag'] == 'textarea') {
                        $html .=
                            '<textarea class="form-control" placeholder="' . ucwords(!empty($value['placeholder']) ? $value['placeholder'] : $value['name']) . '" id="' . $value['name'] . '" type="' . $value['type'] . '" name="' . $value['name'] . '"  aria-describedby="' . $value['name'] . '" tabindex="' . ($key + 1) . '" >' . (!empty($value['value']) ? $value['value'] : '') . '</textarea>';
                    }

                    $html .=
                        '<small class="error ' . $value['name'] . '-error"></small>
                </div>';
                }
            }

            $html .= ' </div></div>
            </div>';
        }
        // if(empty($formArray['no_submit']))
        // {
        //     $html .=
        //         '<div class="col col-md-'.(!empty($formArray['btnGrid']) ? $formArray['btnGrid'] : '12').' mt-2">
        //             <button type="submit" class="btn btn-primary w-100 text-capitalize" tabindex="4">'.(!empty($formArray['submit']) ? $formArray['submit'] : 'save').'</button>
        //         </div>';
        // }

        $html .= '  <div class="  col-md-12 col-sm-12 col-12 justify-content-between">
                        <div class="row justify-content-between">
                        <div class="col-md-7 col-sm-6 col-12">
                            <div class="row">';
        if (!empty($formArray['bulk_action_url']) && ($formArray['bulk_delete'] || $formArray['bulk_status'])) {

            $html .= '
                                        <div class="col-6 col-sm-6 col-md-3">
                                            <select class="form-select  datatable_bulk_action" name="datatable_bulk_action" disabled data-actionurl="' . $formArray['bulk_action_url'] . '">
                                                <option value="" selected>Action</option>'
                . ($formArray['bulk_status'] ? '<option value="active">Active All</option><option value="deactive">Deactive All</option>' : '')
                . ($formArray['bulk_delete'] ? '<option value="delete">Delete All</option>' : '') .

                '</select>
                                                        </div>';

        }
        $html .= '
                            <div class="  col-md-4 col-sm-6 col-6">
                                <div class="form-group">
                                ' . limitDropDownData(10) . '
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class=" col-md-5 col-sm-6  col-12 row d-flex justify-content-end">
                            <div class=" col-md-10  col-sm-10 col-10 m-0">
                                <div class=" input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="search"></i></span>
                                    <input type="text" class="form-control" name="search" placeholder="Search" />
                                </div>
                            </div>';
        if (!empty($formArray['fieldData'])) {
            $html .= '           <div class="col-md-2  col-sm-2 col-2  ps-0">

                                                <button class="btn btn-outline-primary waves-effect waves-float waves-light" type="button"
                                                    data-bs-toggle="offcanvas" data-bs-target=".Filteroffcanvas" aria-controls="Filteroffcanvas">
                                                    <i data-feather="filter"></i>
                                                </button>
                                            </div>';
        }
        $html .= '       </div>
                        </div>
                    </div>


                    <input type="hidden" name="sort" value="id">
                    <input type="hidden" name="direction" value="desc">';

        $html .=
            '</form>';
    }
    return $html;
}
#---------------

#function for pass sidebar array content ---------------
function sideContentData($array = [])
{

    #lable shows menu name in sidebar (STRING)
    #icon shows menu icon in sidebar (STRING)
    #link redirection on click (STRING)
    #link_attribute is set attribute in link  (ARRAY)
    #roles is shows menu logged in user role wise (ARRAY)
    #childData user to create submenu (ARRAY)

    $data = [
    ];

    return $data;
}
#---------------

#function for create html form content ---------------
function limitDropDownData($limit = 5)
{
    $limitData = [5, 10, 25, 50, 100, 250, 500, 1000];
    $html = '<select class="form-select select2" name="limit">
                <option value="1">1 row</option>';
    foreach ($limitData as $val) {
        $html .= '<option ' . ($limit == $val ? ' selected ' : '') . ' value="' . $val . '">' . $val . ' rows</option>';
    }
    $html .= '</select>';
    return $html;
}
#---------------

#function for return faild json data ---------------
function faildResponse($array = [])
{
    $array['Status'] = (int) 400;
    $array['Code'] = !empty($array['Code']) ? $array['Code'] : 400;
    return response()->json($array);
}
#---------------

#function for return success json data ---------------
function successResponse($array = [])
{
    $array['Status'] = (int) 200;
    $array['Code'] = !empty($array['Code']) ? $array['Code'] : 200;
    $array['Data'] = !empty($array['Data']) ? $array['Data'] : [];

    return response()->json($array);
}
#---------------
#function for return faild json data ---------------
function makeResponse($array = [], $is_success = true)
{
    $array['Status'] = (int) (isset($array['Status']) ? $array['Status'] : ($is_success ? 200 : 400));
    $array['Code'] = isset($array['Code']) && !empty($array['Code']) ? $array['Code'] : $array['Status'];
    $array['Data'] = isset($array['Data']) && !empty($array['Data']) ? $array['Data'] : [];
    $array['Message'] = isset($array['Message']) ? $array['Message'] : "";
    $array['Count'] = isset($array['Count']) ? $array['Count'] : count($array['Data']);
    return response()->json($array);
}
#---------------

// Assuming you want to convert 1 to 'A', 2 to 'B', and so on
function numberToCharacterString($number)
{
    $numberStr = strval($number);
    // Initialize an empty result string
    $result = '';
    // Iterate through each digit in the number and map it to a character
    for ($i = 0; $i < strlen($numberStr); $i++) {
        $digit = intval($numberStr[$i]);

        if ($digit >= 0 && $digit <= 26) {
            // Assuming you want to convert 1 to 'A', 2 to 'B', and so on
            // Using ASCII values to convert
            $result .= chr(ord('A') + $digit);
        }
    }
    return $result;
}

function site_logo()
{
    return (file_exists(public_path('images/logo/' . setting('site_logo'))) ? asset('images/logo/' . setting('site_logo')) : asset('images/logo/logo.png'));
}

function site_favicon_logo()
{
    return (file_exists(public_path('images/logo/' . setting('site_favicon_logo'))) ? asset('images/logo/' . setting('site_favicon_logo')) : asset('images/logo/logo.png'));
}

function getInitials($full_name)
{
    if (count(explode(' ', $full_name)) == 1)
        return strtoupper(substr($full_name, 0, 2));
    return substr(implode('', array_map(fn($word) => (strtoupper(substr($word, 0, 1))), explode(' ', $full_name, 2))), 0, 2);
}
// return implode('', array_map(fn($word) => ((explode(' ', $full_name)>1)?strtoupper(substr($word, 0, 1)):strtoupper(substr($word, 2))), explode(' ', $full_name)));

function getRandomColorState()
{
    $color_states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
    return $color_states[array_rand($color_states)];
}

function url_file_exists($pathOrUrl)
{
    $extension = pathinfo($pathOrUrl, PATHINFO_EXTENSION);
    // Check if the URL has a file extension
    if (!empty($extension))
        return file_exists(str_replace(URL, PATH, $pathOrUrl));
    return false;
}

#----------------------------------------------------------------
#Function to get User Avatar
function getUserNameWithAvatar($name = '', $image = NULL, $position = ' ')
{
    if ($name == '')
        return $name;

    $Initials = getInitials($name);
    $randomState = getRandomColorState();
    $user_parent_profile = '<span class="avatar-content">' . $Initials . '</span>';

    $user_parent_profile = url_file_exists($image) ?
        '<img src="' . $image . '" alt="' . $name . '" height="32" width="32">' : $user_parent_profile;

    $user_parent_profile =
        '<div class="d-flex justify-content-left align-items-center">
            <div class="avatar-wrapper">
                <div class="avatar  bg-light-' . $randomState . '  me-1">
                ' . $user_parent_profile . '
                </div>
            </div>
            <div class="d-flex flex-column">
                <a href="javascript:void(0);" class="user_name text-truncate text-body">
                <span class="fw-bolder">' . ucwords($name) . '</span>
                </a>
                <small class="emp_post text-muted">' . $position . '</small>
            </div>
        </div>';
    return $user_parent_profile;
}

if (!function_exists('deleteImage')) {
    function deleteImage($table, $id, $image, $column)
    {

        $table = decrypt_to($table);

        $image = urldecode($image);

        // dd($image);
        $data = DB::table($table)->where('id', $id)->first();

        if (!$data) {
            return ['success' => false, 'message' => 'Data not found.'];
        }

        $images = json_decode($data->$column ?? '[]', true);


        $filtered = array_filter($images, function ($img) use ($image) {
            return $img !== $image;
        });

        DB::table($table)->where('id', $id)->update([
            $column => json_encode(array_values($filtered)),
        ]);

        $imagePath = public_path($image);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }


        return ['success' => 'true', 'message' => 'Image deleted successfully.'];
    }
}

#----------------------------------------------------------------

#function for pass sidebar array content ---------------
function getCustomModule()
{

    #------------------------------------------------------------------------------------------------------
    # NOTE:
    # Do not change the array key name and value name
    # give the unique slug name for modules
    # Do not change the slug name for modules
    # in slug name use only small letter and underscore(not use space, special character,numbers)
    #------------------------------------------------------------------------------------------------------


    #======================================================================================================
    #======================================================================================================
    #SLUG is unqiue for module
    #NAME is name of module
    #PERMISSION is array of permission name
    # example of permission array`
    # [
    #         'name' => 'demo module',
    #         'slug' => 'demo_module',
    # 'permission' =>['read' ,'create','edit','delete','view','status','import','export']
    #     ],
    #======================================================================================================
    #======================================================================================================
    $data = [
        #====================================================================================================
        #============================ do not change and do not clear ========================================
        #====================================================================================================
        [
            'name' => 'User Module',
            'slug' => strtolower(trim('user')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Role',
            'slug' => strtolower(trim('role')),
            'permission' => ['read', 'create', 'edit', 'delete']
        ],
        [
            'name' => 'Permission',
            'slug' => strtolower(trim('permission')),
            'permission' => ['read', 'edit']
        ],
        #====================================================================================================
        #============================ do not change and do not clear ========================================
        #====================================================================================================
        [
            'name' => 'Product Tags',
            'slug' => strtolower(trim('producttags')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Categories',
            'slug' => strtolower(trim('categories')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Variants',
            'slug' => strtolower(trim('variants')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Product Flags',
            'slug' => strtolower(trim('productflags')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Brands',
            'slug' => strtolower(trim('brands')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Order Status',
            'slug' => strtolower(trim('orderstatus')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Coupons',
            'slug' => strtolower(trim('coupons')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Banners',
            'slug' => strtolower(trim('banners')),
            'permission' => ['read', 'create', 'edit', 'delete', 'status']
        ],
        [
            'name' => 'Products',
            'slug' => strtolower(trim('products')),
            'permission' => ['read' ,'create','edit','delete','status']
        ],
        [
            'name' => 'Product Reviews',
            'slug' => strtolower(trim('productreview')),
            'permission' => ['read' ,'create','edit','delete','status']
        ],
        [
            'name' => 'Clients',
            'slug' => strtolower(trim('client')),
            'permission' => ['read','create','edit','delete','status']
        ],
    ];

    return $data;
}

function getStaffRoleName($role_id = NULL)
{
    if (empty($role_id))
        return '';

    $role = \App\Models\StaffRole::find($role_id);
    if ($role)
        return $role->name;

    return '';
}
