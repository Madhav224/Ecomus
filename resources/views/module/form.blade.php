@extends('layouts/contentLayoutMaster')
@section('title', 'Module Form')

@section('vendor-style')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Button Css --}}
    <style>
        .remove-btn {
            width: 30px !important;
            height: 30px !important;
            position: absolute;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            top: 2px;
            right: 28px;
            padding: 0.8rem;
            /* box-shadow: 0 5px 20px 0 rgba(255, 0, 0, 0.1); */
            border-radius: 0.357rem;
            background-color: #fff;
            opacity: 1;
            transition: all 0.23s ease 0.1s;
            transform: translate(18px, -10px);
            cursor: pointer;
        }

        .remove-btn i {
            font-size: 1.4rem;
        }

        .remove-btn:hover,
        .remove-btn:focus,
        .remove-btn:active {
            opacity: 1;
            outline: none;
            transform: translate(15px, -2px);
            box-shadow: none;
        }

        .field_copy_btn {
            width: 30px !important;
            height: 30px !important;
            position: absolute;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            top: 2px;
            right: 64px;
            padding: 0.8rem;
            /* box-shadow: 0 5px 20px 0 rgba(255, 0, 0, 0.1); */
            border-radius: 0.357rem;
            background-color: #fff;
            opacity: 1;
            transition: all 0.23s ease 0.1s;
            transform: translate(18px, -10px);
            cursor: pointer;
        }

        .field_copy_btn i {
            font-size: 1rem;
        }

        .field_copy_btn:hover,
        .field_copy_btn:focus,
        .field_copy_btn:active {
            opacity: 1;
            outline: none;
            transform: translate(15px, -2px);
            box-shadow: none;
        }


        .remove-input-btn {
            cursor: pointer;
        }
    </style>
    {{-- Css Button Css --}}
@endsection

<!-- BEGIN: Content-->
@section('content')

    <div class="content-body">
        <section>
            <div class="row">
                <div class="accordion accordion-margin" id="accordionMargin">
                    <div class=" card">
                        <h2 class="accordion-header " id="headingMarginTwo">
                            <button class="accordion-button collapsed text-danger rounded" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordionMarginTwo" aria-expanded="false"
                                aria-controls="accordionMarginTwo">
                                Module creation note
                            </button>
                        </h2>
                        <div id="accordionMarginTwo" class="accordion-collapse collapse" aria-labelledby="headingMarginTwo"
                            data-bs-parent="#accordionMargin">
                            <div class="accordion-body">
                                <ul>
                                    <li>The name field cannot use any of the reserved names (e.g., id, updated_at,
                                        created_at, status).</li>
                                    <li>The name field must be unique. Please make sure that each name is different to avoid
                                        duplicates.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Invoice repeater -->
                <div class="col-12">
                    <form id="module_form" name="#" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="card">

                            <div class="card-body">
                                <input type="hidden" name="module_id" id="module_id" value="{{ $module?->id ?? 0 }}">

                                <input type="hidden" name="table_name" id="table_name"
                                    value="{{ $module?->table_name ?? null }}">


                                <div class="mb-1">
                                    <label for="module_name">Module Name<span class="text-danger">
                                            *</span></label>

                                    <input type="text" id="module_name" name="module_name"
                                        value="{{ $module?->module_name }}" class="form-control " placeholder="Module Name"
                                        aria-label="Name" aria-describedby="module_name" />
                                    <span class="error-message text-danger"></span>
                                </div>


                                <div>
                                    <label for="form_type">Form Type<span class="text-danger">
                                            *</span></label>
                                    <select class="form-select" id="form_type" name="form_type"
                                        data-modid="{{ $module?->id ?? 0 }}" data-prevval="">
                                        <option value="">Select Form Type</option>
                                        <option value="no_form" {{ $module?->form_type == 'no_form' ? 'selected' : '' }}>
                                            Not Form</option>
                                        <option value="model" {{ $module?->form_type == 'model' ? 'selected' : '' }}>
                                            Form In Model</option>
                                        <option value="form" {{ $module?->form_type == 'form' ? 'selected' : '' }}>
                                            Form
                                            In One Page</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="1" name="has_api" id="has_api"
                                {{ $module?->has_api == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_api">
                                Enable Api
                            </label>
                        </div>
                        <?php
                        $api_actions = json_decode($module?->api_actions);
                        $disable = empty($module?->has_api) || $module?->has_api == '0' ? 'd-none' : '';

                        ?>
                        <div class="card p-1 {{ $disable }} " id="api_actions_div">

                            <div class="d-flex ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="create" name="api_actions[]"
                                        id="create_api"
                                        {{ !empty($api_actions) && in_array('create', $api_actions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="create_api">
                                        Create Api
                                    </label>
                                </div>
                                <div class="form-check ms-1">
                                    <input class="form-check-input" type="checkbox" value="read" name="api_actions[]"
                                        id="read_api"
                                        {{ !empty($api_actions) && in_array('read', $api_actions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="read_api">
                                        Read Api
                                    </label>
                                </div>
                                <div class="form-check ms-1">
                                    <input class="form-check-input" type="checkbox" value="update" name="api_actions[]"
                                        id="update_api"
                                        {{ !empty($api_actions) && in_array('update', $api_actions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="update_api">
                                        Update Api
                                    </label>
                                </div>
                                <div class="form-check ms-1">
                                    <input class="form-check-input" type="checkbox" value="delete" name="api_actions[]"
                                        id="delete_api"
                                        {{ !empty($api_actions) && in_array('delete', $api_actions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="delete_api">
                                        Delete Api
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card p-1">
                            <h4 class="text-secondary m-0 fw-bolder">Module Form Fields</h4>
                        </div>

                        {{-- <div class="  p-1 "> --}}

                        <div id="repeater-container" class=""> {{-- p-1 mt-2 --}}

                            <!-- Repeater Item -->
                            <?php $IndexNumber = 0; ?> {{-- Use for index number. --}}
                            @if (isset($module->fields) && !empty($module->fields))

                                @foreach ($module->fields as $index => $field)
                                    <div class="card">
                                        <div class="repeater-item  row d-flex align-items-end  p-2"
                                            style="position: relative; " data-index="{{ $index + 1 }}">
                                            <span class="field_copy_btn bg-light-primary shadow border border-primary"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Field">
                                                <i class="bi bi-copy "></i>
                                            </span>
                                            <span class="remove-btn bg-light-danger shadow border border-danger"
                                                data-fid="{{ $field->id }}">
                                                <i class="bi bi-x "></i>
                                            </span>
                                            <input type="hidden" value="{{ $field?->form_sort }}"
                                                name="data[{{ $index + 1 }}][position]"
                                                id="{{ $index + 1 }}position">

                                            <input type="hidden" name="data[{{ $index + 1 }}][field_id]"
                                                value="{{ $field?->id }}" id="{{ $index + 1 }}field_id">

                                            <div class="col-md-9 col-sm-12 mb-1">
                                                <label for="">Title</label>
                                                <input type="text" name="data[{{ $index + 1 }}][title]"
                                                    class="form-control" id="{{ $index + 1 }}title"
                                                    placeholder="Enter Title" value="{{ $field?->title }}">
                                            </div>
                                            <div class="col-md-3 col-sm-12 mb-1 pb-1">

                                                <input class="form-check-input" type="checkbox"
                                                    name="data[{{ $index + 1 }}][required]" value="1"
                                                    id="{{ $index + 1 }}required"
                                                    @if ($field->required == 1) checked @endif>
                                                <label class="form-check-label" for="{{ $index + 1 }}required">
                                                    &nbsp; Mark this field as required
                                                </label>

                                            </div>
                                            <div class="col-md-3 col-sm-12 mb-1">
                                                <label for="fields">Fields</label>
                                                <select class="form-select fields" id="{{ $index + 1 }}fields"
                                                    name="data[{{ $index + 1 }}][fields]"
                                                    value="{{ $field->fields }}" disabled>
                                                    <option value="">Select Your Field</option>
                                                    <option value="text"
                                                        @if ($field->fields == 'text') selected @endif>
                                                        Text
                                                    </option>
                                                    <option value="number"
                                                        @if ($field->fields == 'number') selected @endif>
                                                        Number</option>
                                                    <option value="email"
                                                        @if ($field->fields == 'email') selected @endif>
                                                        Email
                                                    </option>
                                                    <option value="password"
                                                        @if ($field->fields == 'password') selected @endif>
                                                        Password</option>
                                                    <option value="single_file"
                                                        @if ($field->fields == 'single_file') selected @endif>
                                                        Single File</option>
                                                    <option value="multiple_file"
                                                        @if ($field->fields == 'multiple_file') selected @endif>
                                                        Multiple File</option>
                                                    <option value="select"
                                                        @if ($field->fields == 'select') selected @endif>
                                                        Select</option>
                                                    <option value="multiple_select"
                                                        @if ($field->fields == 'multiple_select') selected @endif>Multiple Select
                                                    </option>
                                                    <option value="radio"
                                                        @if ($field->fields == 'radio') selected @endif>
                                                        Radio</option>
                                                    <option value="checkbox"
                                                        @if ($field->fields == 'checkbox') selected @endif>
                                                        Checkbox</option>
                                                    <option value="textarea"
                                                        @if ($field->fields == 'textarea') selected @endif>
                                                        Textarea</option>
                                                    <option value="text_editor"
                                                        @if ($field->fields == 'text_editor') selected @endif>
                                                        Text Editor</option>
                                                    <option value="date"
                                                        @if ($field->fields == 'date') selected @endif>
                                                        Date</option>
                                                    <option value="time"
                                                        @if ($field->fields == 'time') selected @endif>
                                                        Time</option>
                                                    <option value="datetime-local"
                                                        @if ($field->fields == 'datetime-local') selected @endif>
                                                        Datetime Local</option>
                                                    <option value="color"
                                                        @if ($field->fields == 'color') selected @endif>
                                                        Color</option>
                                                    <option value="badge"
                                                        @if ($field->fields == 'badge') selected @endif>
                                                        Badge</option>
                                                    <option value="repeater"
                                                        @if ($field->fields == 'repeater') selected @endif>
                                                        Repeater</option>
                                                    <option value="container_repeater"
                                                        @if ($field->fields == 'container_repeater') selected @endif>
                                                        Container Repeater</option>
                                                </select>

                                                <!-- Hidden input field to pass the selected value -->
                                                <input type="hidden" name="data[{{ $index + 1 }}][fields]"
                                                    value="{{ $field->fields }}">
                                            </div>
                                            <div class="col-md-3 col-sm-12 mb-1">
                                                <label for="name">Name</label>
                                                <input type="text" name="data[{{ $index + 1 }}][name]"
                                                    class="form-control" id="{{ $index + 1 }}name"
                                                    placeholder="Enter Name Of Field" value="{{ $field?->name }}">

                                                {{-- oldname filed --}}
                                                <input type="hidden" name="data[{{ $index + 1 }}][oldname]"
                                                    id="{{ $index + 1 }}oldname" value="{{ $field?->name }}">
                                            </div>
                                            <?php
                                            $disabledFields = ['checkbox', 'radio', 'select', 'multiple_select', 'badge', 'multiple_file', 'single_file', 'repeater', 'container_repeater'];

                                            $disabled_inputs = in_array($field?->fields, $disabledFields) ? 'disabled' : '';
                                            ?>
                                            <div class="col-md-3 col-sm-12 mb-1">
                                                <label for="placeholder">Placeholder</label>
                                                <input type="text" name="data[{{ $index + 1 }}][placeholder]"
                                                    class="form-control" id="{{ $index + 1 }}placeholder"
                                                    placeholder="Enter Of Placeholder" value="{{ $field?->placeholder }}"
                                                    {{ $disabled_inputs }}>
                                            </div>

                                            <div class="col-md-3 col-sm-12 mb-1">
                                                <label for="default_value">Default Value</label>
                                                <input type="text" name="data[{{ $index + 1 }}][default_value]"
                                                    class="form-control" id="{{ $index + 1 }}default_value"
                                                    placeholder="Enter Of Default Value"
                                                    value="{{ $field?->default_val }}" {{ $disabled_inputs }}>
                                            </div>

                                            <?php
                                            $hideshow1 = $field->fields == 'select' || $field->fields == 'multiple_select' ? '' : 'd-none';
                                            ?>

                                            {{-- New For Dynamic Select --}}
                                            <div class="mb-1 select_type_div {{ $hideshow1 }}">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input select_type" type="radio"
                                                        name="data[{{ $index + 1 }}][is_relational]"
                                                        value="static_data" id="{{ $index + 1 }}static_data"
                                                        {{ $field->is_relational == '0' ? 'checked' : '' }} />
                                                    <label for="{{ $index + 1 }}static_data">Static Data</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input select_type" type="radio"
                                                        name="data[{{ $index + 1 }}][is_relational]"
                                                        value="dynamic_data" id="{{ $index + 1 }}dynamic_data"
                                                        {{ $field->is_relational == '1' ? 'checked' : '' }} />
                                                    <label for="{{ $index + 1 }}dynamic_data">Dynamic Data</label>
                                                </div>
                                            </div>
                                            <?php

                                            $hideshow = $field->is_relational == '0' ? 'd-none' : '';
                                            ?>

                                            <div class="col-md-4 col-12 mb-1 dynamic_select_div {{ $hideshow }}">
                                                <label>Table Name</label>
                                                <select class="form-select select_tables"
                                                    aria-label="Dynamic Select Table Name"
                                                    name="data[{{ $index + 1 }}][relational_table]"
                                                    id="{{ $index + 1 }}relational_table"
                                                    data-value="{{ $field->relational_table }}">
                                                    <option value="">select table</option>
                                                </select>
                                            </div>


                                            <div class="col-md-4 col-12 mb-1 dynamic_select_div {{ $hideshow }}">
                                                <label>Field Label</label>
                                                <select class="form-select select_columns" aria-label="Select Label"
                                                    name="data[{{ $index + 1 }}][relational_table_label_field]"
                                                    id="{{ $index + 1 }}relational_table_label_field"
                                                    data-colval="{{ $field->relational_table_label_field }}">

                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-1 dynamic_select_div {{ $hideshow }}">
                                                <label>Field Value</label>
                                                <select class="form-select select_columns" aria-label="Select Value"
                                                    name="data[{{ $index + 1 }}][relational_table_value_field]"
                                                    id="{{ $index + 1 }}relational_table_value_field"
                                                    data-colval="{{ $field->relational_table_value_field }}">

                                                </select>
                                            </div>

                                            {{-- End................... --}}

                                            <?php $SelectedValue = json_decode($field->file_types);
                                            $type_show_hide = in_array($field->fields, ['single_file', 'multiple_file']) == true ? 'block' : 'none';
                                            ?>

                                            <div class="col-md-12 mb-1 file_types_div"
                                                style="display: {{ $type_show_hide }}">
                                                <label for="{{ $index + 1 }}file_types">Choose File Type</label>
                                                <select class="select2 form-select " id="{{ $index + 1 }}file_types"
                                                    multiple name="data[{{ $index + 1 }}][file_types][]">
                                                    <option value="image/jpeg"
                                                        {{ in_array('image/jpeg', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        JPEG</option>
                                                    <option value="image/png"
                                                        {{ in_array('image/png', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        PNG</option>
                                                    <option value="image/gif"
                                                        {{ in_array('image/gif', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        GIF</option>
                                                    <option value="image/bmp"
                                                        {{ in_array('image/bmp', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        BMP</option>
                                                    <option value="image/tiff"
                                                        {{ in_array('image/tiff', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        TIFF</option>
                                                    <option value="image/webp"
                                                        {{ in_array('image/webp', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        WebP</option>
                                                    <option value="image/svg+xml"
                                                        {{ in_array('image/svg+xml', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        SVG</option>
                                                    <option value="audio/mpeg"
                                                        {{ in_array('audio/mpeg', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        Audio (MP3)</option>
                                                    <option value="audio/ogg"
                                                        {{ in_array('audio/ogg', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        Audio (Ogg)</option>
                                                    <option value="audio/wav"
                                                        {{ in_array('audio/wav', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        WAV</option>
                                                    <option value="video/mp4"
                                                        {{ in_array('video/mp4', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        MP4 Video</option>
                                                    <option value="video/webm"
                                                        {{ in_array('video/webm', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        WebM Video</option>
                                                    <option value="video/x-msvideo"
                                                        {{ in_array('video/x-msvideo', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        AVI</option>
                                                    <option value="application/pdf"
                                                        {{ in_array('application/pdf', $SelectedValue ?? []) ? 'selected' : '' }}>
                                                        PDF</option>
                                                    <option
                                                        value="application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                        {{ in_array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        Word Document (DOCX)</option>
                                                    <option
                                                        value="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                        {{ in_array('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        Excel Spreadsheet (XLSX)</option>
                                                    <option
                                                        value="application/vnd.openxmlformats-officedocument.presentationml.presentation"
                                                        {{ in_array('application/vnd.openxmlformats-officedocument.presentationml.presentation', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        PowerPoint Presentation (PPTX)</option>
                                                    <option value="text/plain"
                                                        {{ in_array('text/plain', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        Text File (TXT)</option>
                                                    <option value="application/json"
                                                        {{ in_array('application/json', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        JSON</option>
                                                    <option value="text/csv"
                                                        {{ in_array('text/csv', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        CSV</option>
                                                    <option value="application/zip"
                                                        {{ in_array('application/zip', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        Zip Archive</option>
                                                    <option value="text/html"
                                                        {{ in_array('text/html', $selectedFileTypes ?? []) ? 'selected' : '' }}>
                                                        HTML</option>
                                                </select>

                                                <small class="error {{ $index + 1 }}file_types-error"></small>
                                            </div>

                                            @if (in_array($field->fields, ['container_repeater']))
                                                <?php
                                                $repeater_fields = !empty($field->repeater_fields) ? json_decode($field->repeater_fields) : [];

                                                $SelectedField = !empty($repeater_fields) ? array_column($repeater_fields, 'field') : [];

                                                ?>
                                                <div class="col-md-12 mb-1 repeater_fields_div ">
                                                    <label for="{{ $index + 1 }}repeater_fields">Choose Repeater
                                                        Fields</label>
                                                    <select class="select2 form-select repeater_fields" multiple
                                                        id="{{ $index + 1 }}repeater_fields"
                                                        name="data[{{ $index + 1 }}][repeater_fields][]">
                                                        <option value="text"
                                                            {{ in_array('text', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Text</option>
                                                        <option value="number"
                                                            {{ in_array('number', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Number</option>
                                                        <option value="email"
                                                            {{ in_array('email', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Email</option>
                                                        <option value="password"
                                                            {{ in_array('password', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Password</option>
                                                        <option value="date"
                                                            {{ in_array('date', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Date</option>
                                                        <option value="time"
                                                            {{ in_array('time', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Time</option>
                                                        <option value="datetime-local"
                                                            {{ in_array('datetime-local', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Datetime Local</option>
                                                        <option value="color"
                                                            {{ in_array('color', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Color</option>
                                                        <option value="textarea"
                                                            {{ in_array('textarea', $SelectedField ?? []) ? 'selected' : '' }}>
                                                            Textarea</option>
                                                    </select>
                                                    <small class="error {{ $index + 1 }}repeater_fields-error"></small>
                                                </div>
                                                <div class="repeater_fields_container">
                                                    @if (!empty($repeater_fields))
                                                        @foreach ($repeater_fields as $repeaterindex => $repeatervalue)
                                                            <div class="row repeater-field-item"
                                                                data-value="{{ $repeatervalue?->field }}">
                                                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                                                    <label
                                                                        for="{{ $index + 1 }}repeater{{ $repeaterindex }}field">Field</label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $repeatervalue?->field }}"
                                                                        placeholder="Field" disabled>
                                                                    <input type="hidden"
                                                                        name="data[{{ $index + 1 }}][repeater][{{ $repeaterindex }}][field]"
                                                                        value="{{ $repeatervalue?->field }}"
                                                                        id="{{ $index + 1 }}repeater{{ $repeaterindex }}field">

                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                                                    <label
                                                                        for="{{ $index + 1 }}repeater{{ $repeaterindex }}title">Title</label>
                                                                    <input type="text"
                                                                        name="data[{{ $index + 1 }}][repeater][{{ $repeaterindex }}][title]"
                                                                        class="form-control"
                                                                        id="{{ $index + 1 }}repeater{{ $repeaterindex }}title"
                                                                        placeholder="Enter Title Of Field"
                                                                        value="{{ $repeatervalue?->title }}" required>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                                                    <label
                                                                        for="{{ $index + 1 }}repeater{{ $repeaterindex }}name">Name</label>
                                                                    <input type="text"
                                                                        name="data[{{ $index + 1 }}][repeater][{{ $repeaterindex }}][name]"
                                                                        class="form-control"
                                                                        id="{{ $index + 1 }}repeater{{ $repeaterindex }}name"
                                                                        placeholder="Enter Name Of Field"
                                                                        value="{{ $repeatervalue?->name }}" required>
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                                                    <label
                                                                        for="{{ $index + 1 }}repeater{{ $repeaterindex }}placeholder">Placeholder</label>
                                                                    <input type="text"
                                                                        name="data[{{ $index + 1 }}][repeater][{{ $repeaterindex }}][placeholder]"
                                                                        class="form-control"
                                                                        id="{{ $index + 1 }}repeater{{ $repeaterindex }}placeholder"
                                                                        placeholder="Enter Placeholder"
                                                                        value="{{ $repeatervalue?->placeholder }}">
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                                                    <label
                                                                        for="{{ $index + 1 }}repeater{{ $repeaterindex }}default_value">Default
                                                                        Value</label>
                                                                    <input type="text"
                                                                        name="data[{{ $index + 1 }}][repeater][{{ $repeaterindex }}][default_value]"
                                                                        class="form-control"
                                                                        id="{{ $index + 1 }}repeater{{ $repeaterindex }}default_value"
                                                                        placeholder="Enter Default Value"
                                                                        value="{{ $repeatervalue?->default_value }}">
                                                                </div>
                                                                <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                                                    <label for="{{ $index + 1 }}repeater{{ $repeaterindex }}layout">Field
                                                                        Layout Size</label>

                                                                    <select class="form-select" aria-label=""
                                                                        id="{{ $index + 1 }}repeater{{ $repeaterindex }}layout"
                                                                        name="data[{{ $index + 1 }}][repeater][{{ $repeaterindex }}][layout]">
                                                                        <option value="col-md-4"
                                                                            {{ $repeatervalue?->layout == 'col-md-4' ? 'selected' : '' }}>
                                                                            4 Columns Layout</option>
                                                                        <option value="col-md-6"
                                                                            {{ $repeatervalue?->layout == 'col-md-6' ? 'selected' : '' }}>
                                                                            6 Columns Layout</option>
                                                                        <option value="col-md-8"
                                                                            {{ $repeatervalue?->layout == 'col-md-8' ? 'selected' : '' }}>
                                                                            8 Columns Layout</option>
                                                                        <option value="col-md-10"
                                                                            {{ $repeatervalue?->layout == 'col-md-10' ? 'selected' : '' }}>
                                                                            10 Columns Layout</option>
                                                                        <option value="col-md-12"
                                                                            {{ $repeatervalue?->layout == 'col-md-12' ? 'selected' : '' }}>
                                                                            12 Columns Layout</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>
                                            @endif



                                            <div class="row repeater-input-container">
                                                @if (in_array($field->fields, ['radio', 'select', 'checkbox', 'multiple_select', 'badge']))
                                                    @if (!empty($field->options))
                                                        @foreach (json_decode($field->options, true) as $key => $option)
                                                            @if (!empty($option))
                                                                <div
                                                                    class="repeater-input-text  col-md-3 col-sm-6 col-12  mt-1">
                                                                    <div class="input-group">
                                                                        <?php $default = json_decode($field?->default_val);

                                                                        $badge_colors = json_decode($field->badge_color);

                                                                        [$option_div, $badge_div] = $field->fields === 'badge' ? ['d-none', ''] : ['', 'd-none'];
                                                                        $colorValue = isset($badge_colors[$key]) ? $badge_colors[$key] : '#000000';
                                                                        ?>


                                                                        <div
                                                                            class="input-group-text option_div  {{ $option_div }}">
                                                                            <input
                                                                                type="{{ $field->fields === 'radio' || $field->fields === 'select' ? 'radio' : 'checkbox' }}"
                                                                                class="form-check-input option_val"
                                                                                value="{{ $option }}"
                                                                                name="data[{{ $index + 1 }}][options_val][]"
                                                                                {{ !empty($default) && in_array($option, $default) ? 'checked' : '' }}
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="Set as Default" />
                                                                        </div>

                                                                        <div
                                                                            class="input-group-text p-0  rounded-start badge_div {{ $badge_div }}">
                                                                            <input type="color"
                                                                                class="form-control form-control-sm form-control-color "
                                                                                name="data[{{ $index + 1 }}][badge_color][]"
                                                                                value="{{ $colorValue }}"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="bottom"
                                                                                title="Set as Default">
                                                                        </div>

                                                                        <input type="text" id="options"
                                                                            name="data[{{ $index + 1 }}][options][]"
                                                                            id="{{ $index + 1 }}options"
                                                                            class="form-control form-control-sm"
                                                                            placeholder="Enter Option"
                                                                            value="{{ $option }}">

                                                                        <span
                                                                            class="remove-input-btn input-group-text text-dark bg-light-danger">
                                                                            <i class="bi bi-x "></i>
                                                                        </span>

                                                                    </div>
                                                                    <small class="error {{ $index + 1 }}options-error"></small>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>


                                            <?php
                                            $btn_hideshow = in_array($field->fields, ['radio', 'checkbox', 'select', 'multiple_select', 'badge']) == false || $field->is_relational == '1' ? 'none' : 'block';
                                            ?>
                                            <div class="col-md-2 mt-1 col-12 repeater-input-btn"
                                                style="display:{{ $btn_hideshow }}">

                                                <button type="button" class="btn btn-outline-primary add-option-btn"><i
                                                        data-feather='plus'></i>Add
                                                    Option</button>
                                            </div>
                                            <?php $IndexNumber = $index + 1; ?>


                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>



                        <div class="card p-1 ">

                            <div class="d-flex justify-content-between align-items-center row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                    <button type="button" id="add-btn" class="btn  btn-outline-primary "
                                        {{ $module?->form_type == 'no_form' ? 'disabled' : '' }}><i
                                            data-feather='plus'></i>Add
                                        More Fields</button>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 d-flex justify-content-end align-items-end">

                                    <a href="{{ route('module.index') }}" class="btn btn-secondary"><i
                                            data-feather='skip-back'></i> Close</a>
                                    <button type="submit" class="btn btn-primary   ms-1" name="submit"
                                        id="SaveBtn"><i data-feather='save'></i> Save
                                        Changes</button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>
                <!-- /Invoice repeater -->
            </div>
        </section>

    </div>
@endsection


<!-- BEGIN: Java Script-->
@section('page-script')
    <script>
        let inputType = 'checkbox';

        function relational_tables(selectElement = "", sel_clas = "") {
            if (sel_clas != "") {
                elementValue = $("." + sel_clas).data('value');
            }
            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ route('get.tables_columns') }}",
                data: {
                    'type': 'tables'
                },
                success: function(data) {
                    if (data.status == 200) {
                        if (typeof data === 'object' && data !== null) {
                            var option = '';
                            option += $('<option></option>').attr('value', '').text('Select Tables')
                                .prop('outerHTML');
                            Object.keys(data.data).forEach(function(key) {
                                var value = data.data[key];
                                option += $('<option></option>').attr('value', value).text(
                                    value).prop('outerHTML');
                            });
                            var SelectObject = sel_clas != '' ? $('.' + sel_clas) : $(
                                selectElement);
                            SelectObject.each(function() {
                                $(this).html('').append(option).val($(this).data('value'))
                                    .trigger('change');
                            });

                        }
                    } else if (data.status == 500) {
                        toastr.info(`👋 Tables not found!`,
                            'Not Found', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }
                },
                error: function(error) {
                    console.log(error.responseText);
                    toastr.info(`👋 Tables not found!`,
                        'Not Found', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                }

            });
        }

        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            relational_tables("", "select_tables");
            $('.select2').select2();
        });

        let repeaterIndex = {{ $IndexNumber ?? 0 }}; // index for inputs

        $(document).ready(function() {

            $("#add-btn").click(function() {
                repeaterIndex++;
                const repeatHtml = `
                            <div class="card" style="display: none;">
                            <div class="repeater-item  row d-flex align-items-end   p-1" style="position: relative;  " data-index="${repeaterIndex}">
                                            <span class="field_copy_btn bg-light-primary shadow border border-primary"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Field">
                                                <i class="bi bi-copy "></i>
                                            </span>
                                             <span class="remove-btn bg-light-danger shadow border border-danger" data-fid="0">

                                                        <i class="bi bi-x" ></i>
                                                </span>
                                                 <input type="hidden" value=""
                                                                name="data[${repeaterIndex}][position]">

                                                            <input type="hidden" name="data[${repeaterIndex}][field_id]" value="">

                                            <div class="col-md-9 col-sm-12 mb-1">
                                                <label for="">Title</label>
                                                <input type="text" name="data[${repeaterIndex}][title]" id="${repeaterIndex}title" class="form-control"
                                                    placeholder="Enter Title" >
                                            </div>
                                            <div class="col-md-3 col-sm-12 mb-1 pb-1">

                                                <input class="form-check-input" type="checkbox" name="data[${repeaterIndex}][required]"
                                                    value="1" id="${repeaterIndex}required">
                                                <label class="form-check-label" for="${repeaterIndex}required">
                                                    &nbsp; Mark this field as required
                                                </label>

                                            </div>
                                            <div class="col-md-3 col-sm-12 mb-1">
                                                <label for="fields">Fields</label>
                                                <select class="form-select fields" id="${repeaterIndex}fields" name="data[${repeaterIndex}][fields]">
                                                    <option value="">Select Your Field</option>
                                                    <option value="text">Text</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                    <option value="password">Password</option>
                                                    <option value="single_file">Single File</option>
                                                    <option value="multiple_file">Multiple File</option>
                                                    <option value="select">Select</option>
                                                    <option value="multiple_select">Multiple Select</option>
                                                    <option value="radio">Radio</option>
                                                    <option value="checkbox">Checkbox</option>
                                                    <option value="textarea">Textarea</option>
                                                    <option value="text_editor">Text Editor</option>
                                                    <option value="date">Date</option>
                                                    <option value="time">Time</option>
                                                    <option value="datetime-local">Datetime Local</option>
                                                    <option value="color">Color</option>
                                                    <option value="badge">Badge</option>
                                                    <option value="repeater">Repeater</option>
                                                    <option value="container_repeater">Container Repeater</option>
                                                </select>
                                            </div>
                                             <div class="col-md-3 col-sm-12 mb-1">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="data[${repeaterIndex}][name]"
                                                        class="form-control" id="${repeaterIndex}name" placeholder="Enter Name Of Field" >
                                            </div>
                                            <div class="col-md-3 col-sm-12 mb-1">
                                                   <label for="placeholder">Placeholder</label>
                                                    <input type="text" name="data[${repeaterIndex}][placeholder]"
                                                        class="form-control field_placeholder" id="${repeaterIndex}placeholder" placeholder="Enter Of Placeholder"
                                                        >
                                            </div>

                                            <div class="col-md-3 col-sm-12 mb-1">
                                                    <label for="default_value">Default Value</label>
                                                    <input type="text" name="data[${repeaterIndex}][default_value]"
                                                        class="form-control default_value" id="${repeaterIndex}default_value" placeholder="Enter Of Default Value"
                                                        >
                                            </div>

                                              <div class="mb-1 select_type_div d-none">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input select_type" type="radio"
                                                        name="data[${repeaterIndex}][is_relational]"
                                                        value="static_data"
                                                        id="${repeaterIndex}static_data" />
                                                    <label for="${repeaterIndex}static_data">Static Data</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input select_type" type="radio"
                                                        name="data[${repeaterIndex}][is_relational]"
                                                        value="dynamic_data"
                                                        id="${repeaterIndex}dynamic_data" />
                                                    <label for="${repeaterIndex}dynamic_data">Dynamic Data</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12 mb-1 dynamic_select_div d-none">
                                                <label>Table Name</label>
                                                <select class="form-select select_tables"
                                                    aria-label="Dynamic Select Table Name" name="data[${repeaterIndex}][relational_table]"
                                                     id="${repeaterIndex}relational_table" data-value="">

                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-1 dynamic_select_div d-none">
                                                <label>Field Label</label>
                                                <select class="form-select select_columns" aria-label="Select Label" name="data[${repeaterIndex}][relational_table_label_field]" id="${repeaterIndex}relational_table_label_field" data-colval="">
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-1 dynamic_select_div d-none">
                                                <label>Field Value</label>
                                                <select class="form-select select_columns" aria-label="Select Value" name="data[${repeaterIndex}][relational_table_value_field]" id="${repeaterIndex}relational_table_value_field" data-colval="">
                                                </select>
                                            </div>

                                            <div class="col-md-12 mb-1 file_types_div" style="display:none">
                                                    <label  for="${repeaterIndex}file_types">Choose File Type</label>
                                                    <select class="select2 form-select file_types" id="${repeaterIndex}file_types"  multiple name="data[${repeaterIndex}][file_types][]">
                                                            <option value="image/jpeg">JPEG</option>
                                                            <option value="image/png">PNG</option>
                                                            <option value="image/gif">GIF</option>
                                                            <option value="image/bmp">BMP</option>
                                                            <option value="image/tiff">TIFF</option>
                                                            <option value="image/webp">WebP</option>
                                                            <option value="image/svg+xml">SVG</option>
                                                            <option value="audio/mpeg">Audio (MP3)</option>
                                                            <option value="audio/ogg">Audio (Ogg)</option>
                                                            <option value="audio/wav">WAV</option>
                                                            <option value="video/mp4">MP4 Video</option>
                                                            <option value="video/webm">WebM Video</option>
                                                            <option value="video/x-msvideo">AVI</option>
                                                            <option value="application/pdf">PDF</option>
                                                            <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document">Word Document (DOCX)</option>
                                                            <option value="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">Excel Spreadsheet (XLSX)</option>
                                                            <option value="application/vnd.openxmlformats-officedocument.presentationml.presentation">PowerPoint Presentation (PPTX)</option>
                                                            <option value="text/plain">Text File (TXT)</option>
                                                            <option value="application/json">JSON</option>
                                                            <option value="text/csv">CSV</option>
                                                            <option value="application/zip">Zip Archive</option>
                                                            <option value="text/html">HTML</option>
                                                            <option value="text/markdown">Markdown</option>

                                                    </select>

                                                    <small class="error ${repeaterIndex}file_types-error"></small>
                                            </div>
                                            <div class="col-md-12 mb-1 repeater_fields_div d-none" >
                                                    <label  for="${repeaterIndex}repeater_fields">Choose Repeater Fields</label>
                                                    <select class="select2 form-select repeater_fields"  multiple id="${repeaterIndex}repeater_fields" name="data[${repeaterIndex}][repeater_fields][]">
                                                    <option value="text">Text</option>
                                                    <option value="number">Number</option>
                                                    <option value="email">Email</option>
                                                    <option value="password">Password</option>
                                                    <option value="date">Date</option>
                                                    <option value="time">Time</option>
                                                    <option value="datetime-local">Datetime Local</option>
                                                    <option value="color">Color</option>
                                                    <option value="textarea">Textarea</option>
                                                      </select>
                                                      <small class="error ${repeaterIndex}repeater_fields-error"></small>
                                            </div>
                                            <div class="repeater_fields_container">


                                            </div>


                                            <div class="row repeater-input-container"  style="display:none;">

                                                <div class="repeater-input-text col-md-3 col-sm-6 col-12  mt-1">
                                                        <div class="input-group">

                                                                <div class="input-group-text option_div">
                                                                    <input type="${inputType}" class="form-check-input option_val" value="" name="data[${repeaterIndex}][options_val][]" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Set as Default" />
                                                                </div>

                                                                <div class="input-group-text p-0  rounded-start badge_div d-none">
                                                                    <input type="color" class="form-control form-control-sm form-control-color " value="" name="data[${repeaterIndex}][badge_color][]" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Set as Default">
                                                                </div>
                                                            <input type="text"  name="data[${repeaterIndex}][options][]" id="${repeaterIndex}options" class="form-control field_option"
                                                                placeholder="Options" value="">
                                                            <span class="remove-input-btn input-group-text text-dark bg-light-danger"
                                                                type="button" >
                                                                    <i class="bi bi-x " ></i>
                                                            </span>
                                                        </div>
                                                        <small class="error ${repeaterIndex}options-error"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-1 col-12 repeater-input-btn"
                                                style="display:none;">

                                                <button type="button" class="btn btn-outline-primary add-option-btn"><i
                                                    data-feather='plus'></i>Add
                                                    Option</button>
                                            </div>


                                        </div>
                                        </div>

                                        `;

                const $repeatElement = $(repeatHtml);

                $('#repeater-container').append($repeatElement);
                $repeatElement.slideDown(200); // Adds slide-down effect
                feather.replace();
                $('.select2').select2();
                $repeatElement.find('[data-bs-toggle="tooltip"]').tooltip();
            });

            // Remove repeater For Form Feilds
            $(document).on('click', '.remove-btn', function() {

                let optionId = $(this).data('fid');
                let btn = $(this);


                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Delete This Field!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ms-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        if (optionId > 0) {

                            $.ajax({
                                type: "post",
                                dataType: "json",
                                url: "{{ route('delete.fields') }}",
                                data: {
                                    "did": optionId
                                },
                                success: function(data) {
                                    if (data.status == 200) {

                                        btn.closest('.repeater-item').find(
                                            'input, select, textarea').prop(
                                            'disabled', true);

                                        btn.closest('.repeater-item').parent('.card')
                                            .remove();

                                        toastr['success'](
                                            '👋 Feild Deleted Successfully !',
                                            'Deleted', {
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    } else {
                                        toastr['error'](
                                            '👋 ' + data.message,
                                            'Not Deleted', {
                                                closeButton: true,
                                                tapToDismiss: false
                                            });


                                    }

                                },
                                error: function() {
                                    toastr.info(`👋 This Feild Not Deleted!`,
                                        'Not Deleted', {
                                            closeButton: true,
                                            tapToDismiss: false
                                        });
                                }
                            });

                        } else {

                            btn.closest('.repeater-item').find('input, select, textarea').remove();
                            btn.closest('.repeater-item').parent('.card').remove();
                            toastr['success']('👋 Field Deleted Successfully !', 'Deleted', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    } else
                        notDeleted();
                });


            });
            // --------------------

            // ---------------------
            $(document).on('click', '.add-option-btn', function() {
                let parentItem = $(this).closest('.repeater-item');

                let inputContainer = parentItem.find('.fields').val();
                inputType = (inputContainer === 'radio' || inputContainer === 'select') ? 'radio' :
                    'checkbox';
                parentIndex = parentItem.data('index');

                var [option, badge] = inputContainer === "badge" ? ["d-none", ""] : ["", "d-none"];

                const OptionHtml = `
                                                <div class="repeater-input-text col-md-3 col-sm-6 col-12   mt-1">
                                                    <div class="input-group">

                                                        <div class="input-group-text option_div ${option}">
                                                            <input type="${inputType}" class="form-check-input option_val" value="" name="data[${parentIndex}][options_val][]" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Set as Default" />
                                                        </div>

                                                         <div class="input-group-text p-0  rounded-start badge_div ${badge}">
                                                            <input type="color" class="form-control form-control-sm form-control-color " value="" name="data[${parentIndex}][badge_color][]" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Set as Default">
                                                        </div>

                                                    <input type="text"  name="data[${parentIndex}][options][]" id="${parentIndex}options" class="form-control field_option"
                                                        placeholder="Options" >

                                                    <span class="remove-input-btn input-group-text text-dark bg-light-danger"
                                                         type="button" >
                                                             <i class="bi bi-x " ></i>
                                                    </span>
                                                    </div>
                                                    <small class="error ${parentIndex}options-error"></small>
                                                </div>
                         `;

                feather.replace();
                parentItem.find('.repeater-input-container').append(OptionHtml).show(); // Append new item
                parentItem.find('[data-bs-toggle="tooltip"]').tooltip();
            });


            // Remove repeater For Form Feilds
            $(document).on('click', '.remove-input-btn', function() {
                var this_content = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to Delete This Field!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Delete it!',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                        cancelButton: 'btn btn-outline-danger ms-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    if (result.value) {
                        $(this_content).closest('.repeater-input-text')
                            .remove(); // Remove the parent row
                        toastr['success'](
                            '👋 Feild Deleted Successfully !',
                            'Deleted', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    } else {
                        toastr.info(`👋 This Feild Not Deleted!`,
                            'Not Deleted', {
                                closeButton: true,
                                tapToDismiss: false
                            });
                    }
                });
            });
            // ---------------------



            $(document).on('change', '.fields', function() {
                var this_input = $(this);
                let parentRepeaterItem = $(this).closest(
                    '.repeater-item'); // Get the parent repeater item
                let selectedValue = $(this).val(); // Get the selected value
                let inputContainer = parentRepeaterItem.find('.repeater-input-container');
                let inputButton = parentRepeaterItem.find('.repeater-input-btn');
                var changetype = inputContainer.find('.repeater-input-text'),
                    option_div = inputContainer.find('.option_div'),
                    badge_div = inputContainer.find('.badge_div'),
                    field_placeholder = parentRepeaterItem.find('.field_placeholder'),
                    default_value = parentRepeaterItem.find('.default_value'),
                    repeater_fields_div = parentRepeaterItem.find('.repeater_fields_div');

                let file_types = parentRepeaterItem.find(".file_types_div");
                let dynamic_select_div = parentRepeaterItem.find('.dynamic_select_div');


                let select_type_div = parentRepeaterItem.find('.select_type_div');

                let select_table = parentRepeaterItem.find('.select_tables')
                let select_type = parentRepeaterItem.find('.select_type[value="static_data"]');

                function change_deftype(inputType) {
                    changetype.each(function() {
                        // Find all .option_val inputs inside this specific container
                        $(this).find('.option_val').attr('type', inputType);
                    });
                }

                const disabledFields = ['checkbox', 'radio', 'select', 'multiple_select', 'badge',
                    'multiple_file', 'single_file', 'repeater', 'container_repeater'
                ].includes(selectedValue);
                default_value.attr('disabled', disabledFields);
                field_placeholder.attr('disabled', disabledFields);

                if (['container_repeater'].includes(selectedValue)) {
                    repeater_fields_div.removeClass('d-none');
                    repeater_fields_div.find('select').val(null).trigger('change');
                    repeater_fields_div.find('select').select2({
                        placeholder: "Select Repeater Fields", // Set the placeholder text
                    });
                } else {
                    repeater_fields_div.find('select').val(null).trigger('change');
                    repeater_fields_div.addClass('d-none');
                }

                if (['checkbox', 'radio', 'select', 'multiple_select', 'badge'].includes(selectedValue)) {
                    inputType = (selectedValue === 'radio' || selectedValue === 'select') ? 'radio' :
                        'checkbox';

                    change_deftype(inputType);
                    if (selectedValue === 'select' || selectedValue === 'multiple_select') {

                        badge_div.addClass('d-none');
                        option_div.removeClass('d-none');

                        select_type.prop('checked', true).trigger('change');
                        select_type_div.removeClass('d-none');
                        // inputContainer.find('.repeater-input-text:not(:first)').remove();

                        relational_tables(select_table);

                    } else {

                        if (selectedValue === 'badge') {
                            badge_div.removeClass('d-none');
                            option_div.addClass('d-none');
                        } else {
                            badge_div.addClass('d-none');
                            option_div.removeClass('d-none');
                        }
                        dynamic_select_div.addClass('d-none');
                        inputContainer.show(); // Show the container
                        inputButton.show(); // Show the button
                        select_type_div.addClass('d-none');
                    }
                } else {

                    select_type.prop('checked', false).trigger('change');
                    inputContainer.find('input').val('');
                    dynamic_select_div.addClass('d-none');
                    select_type_div.addClass('d-none');
                    inputContainer.find('.repeater-input-text:not(:first)')
                        .remove(); // Clear any dynamically added fields
                    inputContainer.hide(); // Show the container
                    inputButton.hide();
                }



                if (selectedValue === "single_file" || selectedValue === "multiple_file") {
                    file_types.find('select').val(null).trigger('change');
                    file_types.show();
                    file_types.find('select').select2({
                        placeholder: "Select File types", // Set the placeholder text
                    });
                    // file_types.find('select').addClass("select2");
                } else {
                    file_types.find('select').val(null).trigger('change');
                    file_types.hide();
                }
            });

            $(document).on('change', '.repeater_fields', function() {
                var this_input = $(this);
                let parentRepeaterItem = $(this).closest('.repeater-item'); // Get the parent repeater item
                let selectedValues = $(this).val() || []; // Get the selected value

                parentIndex = parentRepeaterItem.data('index');

                let RepeaterContainer = parentRepeaterItem.find('.repeater_fields_container');
                // Remove fields that are no longer selected
                RepeaterContainer.find('.repeater-field-item').each(function() {
                    let fieldValue = $(this).data('value'); // Get the data-value of existing fields
                    if (!selectedValues.includes(fieldValue)) {
                        $(this).remove(); // Remove if it's not in selectedValues
                    }
                });

                // Append new fields if they don't already exist
                selectedValues.forEach((value, index) => {
                    if (RepeaterContainer.find(`.repeater-field-item[data-value="${value}"]`)
                        .length === 0) {
                        let repeaterIndex = parentIndex; // Adjust index logic if needed
                        let fieldHTML = `
                                  <div class="row repeater-field-item" data-value="${value}">
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                        <label for="${repeaterIndex}repeater${index}field">Field</label>
                                        <input type="text"
                                            class="form-control"  value="${value}" placeholder="Field" disabled>
                                        <input type="hidden" name="data[${repeaterIndex}][repeater][${index}][field]" value="${value}"
                                        id="${repeaterIndex}repeater${index}field">

                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                        <label for="${repeaterIndex}repeater${index}title">Title</label>
                                        <input type="text" name="data[${repeaterIndex}][repeater][${index}][title]"
                                            class="form-control" id="${repeaterIndex}repeater${index}title" placeholder="Enter Title Of Field" required>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                        <label for="${repeaterIndex}repeater${index}name">Name</label>
                                        <input type="text" name="data[${repeaterIndex}][repeater][${index}][name]"
                                            class="form-control" id="${repeaterIndex}repeater${index}name" placeholder="Enter Name Of Field" required>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                        <label for="${repeaterIndex}repeater${index}placeholder">Placeholder</label>
                                        <input type="text" name="data[${repeaterIndex}][repeater][${index}][placeholder]"
                                            class="form-control" id="${repeaterIndex}repeater${index}placeholder" placeholder="Enter Placeholder">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                        <label for="${repeaterIndex}repeater${index}default_value">Default Value</label>
                                        <input type="text" name="data[${repeaterIndex}][repeater][${index}][default_value]"
                                            class="form-control" id="${repeaterIndex}repeater${index}default_value" placeholder="Enter Default Value">
                                    </div>
                                     <div class="col-lg-2 col-md-2 col-sm-6 col-12 mb-1">
                                        <label for="${repeaterIndex}repeater${index}layout">Field Layout Size</label>
                                    <select class="form-select"     id="${repeaterIndex}repeater${index}layout" name="data[${repeaterIndex}][repeater][${index}][layout]">
                                                                        <option value="col-md-4" >4 Columns Layout</option>
                                                                        <option value="col-md-6" >6 Columns Layout</option>
                                                                        <option value="col-md-8" >8 Columns Layout</option>
                                                                        <option value="col-md-10" >10 Columns Layout</option>
                                                                        <option value="col-md-12" >12 Columns Layout</option>
                                                                    </select>
                                                                    </div>
                                </div>`;
                        RepeaterContainer.append(fieldHTML);
                    }
                });
            });

            $(document).on('change', '.select_type', function() {
                var select_type = $(this).val();
                let parentRepeaterItem = $(this).closest(
                    '.repeater-item');
                let inputContainer = parentRepeaterItem.find('.repeater-input-container');
                let inputButton = parentRepeaterItem.find('.repeater-input-btn');
                let dynamic_select_div = parentRepeaterItem.find('.dynamic_select_div');
                let select_table = parentRepeaterItem.find('.select_tables')


                if (select_type === "dynamic_data") {
                    dynamic_select_div.removeClass('d-none');
                    inputContainer.hide();
                    inputButton.hide();
                    // inputContainer.find('.repeater-input-text:not(:first)').remove();
                    // inputContainer.find('input').val('');

                } else {
                    // inputContainer.find('.repeater-input-text:not(:first)').remove();
                    dynamic_select_div.addClass('d-none');
                    inputContainer.show();
                    inputButton.show();
                }
            });



            $(document).on('change', "#form_type", function() {
                var route_slug = "{{ Request::route('slug') }}";


                var sel_val = $(this).val();
                var m_id = $(this).data("modid");
                var prev_val = $(this).data("prevval");
                var repeater_btn = $("#add-btn"); //for disabled and remove disabled
                repeater_btn.prop('disabled', false); // repeater is disabled.

                var alert_msg = route_slug != "" ?
                    "This action will delete all the data associated with this module, and the data cannot be recovered once removed!" :
                    "Are you sure you want to delete all fields!";

                if (sel_val === "no_form") {
                    // var con = confirm("Do You want to delete All feilds..");
                    Swal.fire({
                        title: 'Are you sure?',
                        text: alert_msg,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Delete it!',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                            cancelButton: 'btn btn-outline-danger ms-1'
                        },
                        buttonsStyling: false
                    }).then(function(result) {
                        if (result.value) {
                            repeater_btn.prop('disabled', true); // repeater is disabled.
                            $.ajax({
                                type: "post",
                                dataType: "json",
                                url: "{{ route('delete.fields') }}",
                                data: {
                                    "module_id": m_id
                                },
                                success: function(data) {


                                    if (data.status == 200) {
                                        toastr['success'](
                                            '👋 ' + data.message, "Deleted", {
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                        $("#repeater-container").empty();

                                    } else {
                                        toastr.info(
                                            '👋 ' + data.message,
                                            "Not Deleted", {
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    }
                                }

                            });
                        } else {
                            toastr.info(`👋 This Feilds Not Deleted!`,
                                'Not Deleted', {
                                    closeButton: true,
                                    tapToDismiss: false
                                });
                            $(this).val(prev_val).trigger('change');
                        }
                    });


                }

                if (sel_val === "model" || sel_val === "form") {
                    repeater_btn.prop('disabled', false);

                    if ($('#repeater-container').is(':empty')) {
                        repeater_btn.trigger('click');
                    }
                }

            });

        });

        $('#SaveBtn').on('click', function(e) {
            e.preventDefault(); // Prevent the default form submission


            var formData = new FormData($('#module_form')[0]);
            var form = $('#module_form');

            // Send the AJAX request
            $.ajax({
                url: "{{ route('module.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // Optionally, you can show a loader here
                    $('#SaveBtn').attr('disabled', true).html(
                        '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Wait...</span>'
                    );
                },
                success: function(response) {
                    // Handle success response
                    // alert('Data saved successfully!');
                    if (response.status == 200) {
                        toastr['success'](
                            '👋 ' + response.message,
                            'Module ', {
                                closeButton: true,
                                tapToDismiss: false,
                                onHidden: function() {
                                    location.href = "{{ route('module.index') }}";
                                }
                            });
                        location.href = "{{ route('module.index') }}";
                    } else {
                        toastr['info'](
                            '👋 ' + response.message,
                            'Module ', {
                                closeButton: true,
                                tapToDismiss: false,

                            });
                    }


                },
                error: function(error) {
                    console.log('error :: ', error?.status, error?.statusText)
                    if (error.status === 422) {
                        // Handle validation errors
                        var errors = error.responseJSON.errors;
                        for (var key in errors) {
                            if (errors[key]?.length > 0) {

                                // var convertedString = key.replace(/\[|\]/g, '');
                                var convertedString = key.replace(/\[|\]/g, '');

                                var selecttor = $('[name="' + key + '"]', form).length > 1 ? $(
                                    '[name="' + key + '"]', form)[0] : $('[name="' + key + '"]',
                                    form);


                                selecttor = selecttor.length == 0 ? ($('#' + key, form)
                                    .length > 1 ? $('#' + key, form)[0] : $(
                                        '#' + key, form)) : selecttor;

                                $(selecttor).addClass('error');

                                if ($('.' + convertedString + '-error', form).length > 0) {
                                    $('.' + convertedString + '-error', form).html(errors[key][0]
                                        .replace('_id', '').replace(/_/g, ' '));
                                } else {
                                    $('.' + convertedString + '-error', form).remove();
                                    $('<small class="error ' + convertedString + '-error">' + (errors[
                                            key][0].replace('_id', '').replace(/_/g, ' ')) +
                                        '</small>').insertAfter(selecttor);
                                }
                                toastr.error((errors[key][0].replace('_id', '').replace(/_/g, ' ')) +
                                    '👋',
                                    'Somthing Wrong!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });

                            }
                        }
                    }
                    if (error?.status == 419) {
                        let person = confirm("Page Session is Expired! Reload");
                        if (person)
                            location.reload();
                    }
                },
                complete: function() {
                    // Re-enable the button after the request completes
                    $('#SaveBtn').attr('disabled', false).html(
                        '<i data-feather="save"></i> Save Changes');
                    feather.replace();
                }
            });
        });

        $(document).on('keyup change', 'input,select,date', function(event) {
            // Get the name attribute of the fieldElement
            var inputValue = $(this).attr('id');

            if (inputValue == undefined)
                return;
            // Remove the 'error' class from elements with the specified name
            $('[id="' + inputValue + '"]').removeClass('error');

            // Reset the content of elements with the specified class
            var inputValue = inputValue.replace(/\[|\]/g, '');
            $('.' + inputValue + '-error').html('');
        });




        $(document).on('change', '.select_tables', function() {
            var tablename = $(this).val();
            let parentRepeaterItem = $(this).closest(
                '.repeater-item');
            let column_select = parentRepeaterItem.find('.select_columns');


            $.ajax({
                type: "get",
                dataType: "json",
                url: "{{ route('get.tables_columns') }}",
                data: {
                    'type': 'columns',
                    'table_name': tablename
                },
                success: function(data) {
                    if (data.status == 200) {
                        if (typeof data === 'object' && data !== null) {
                            // Loop through the object keys and values
                            sel_data = data.data;

                            var opt = $('<option></option>').attr('value',
                                '').text(
                                'Select');

                            $(column_select).html(opt);
                            Object.keys(sel_data).forEach(function(key) {
                                var value = sel_data[key];
                                var option = $('<option></option>').attr('value',
                                    value).text(
                                    value);
                                // Append the option to the select element
                                $(column_select).append(option);
                            });

                            column_select.each(function() {
                                let colval = $(this).data(
                                    'colval'
                                ); // Get the data-colval attribute value
                                if (colval !==
                                    undefined) { // Check if colval exists
                                    $(this).val(colval).trigger(
                                        'change'); // Set value and trigger change
                                }
                            });
                        } else {

                            $(column_select).append(
                                '<option>No options available</option>');
                        }
                    }
                    //  else if (data.status == 500) {
                    //     toastr.info(`👋 Tables not found!`,
                    //         'Not Found', {
                    //             closeButton: true,
                    //             tapToDismiss: false
                    //         });
                    // }

                },
                error: function(error) {
                    console.log(error.responseText);
                    toastr.info(`👋 Tables not found!`,
                        'Not Found', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                }
            });

        });


        $(document).on('change', '#has_api', function() {
            var this_val = $(this).prop('checked') == true ? true : false;


            if (this_val) {
                $("#api_actions_div").removeClass("d-none");
            } else {
                $("#api_actions_div").addClass("d-none");
                $('#api_actions_div input').prop("checked", false).trigger('change');
            }

        });


        // jquery for Set value of default value in option value
        $(document).on('keyup', '.field_option', function() {
            var inputValue = $(this).val();
            $(this).closest('div').find('.option_val').val(inputValue);
        });

        $(document).on('click', '.field_copy_btn', function() {
            var this_content = $(this),
                index = $(this).closest('.repeater-item').data('index');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to create a duplicate field!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Duplicate it!',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ms-1'
                },
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    let parentItem = $(this_content).closest('.repeater-item').parent('.card');

                    let repeatHtml = parentItem.clone();
                    repeatHtml.children('.repeater-item').attr('data-index', repeaterIndex + 1);
                    repeatHtml.find('.remove-btn').attr('data-fid', '0');
                    repeatHtml.find('[name^="data["], [id] , [for]').each(function() {
                        let oldName = $(this).attr("name"),
                            oldId = $(this).attr("id"),
                            oldfor = $(this).attr("for");

                        if (oldName) {
                            let newName = oldName.replace(/\d+/, repeaterIndex + 1);
                            $(this).attr("name", newName);
                        }

                        // Update 'id' attribute (format: index + name)
                        if (oldId) {
                            let newId = oldId.replace(/\d+/, repeaterIndex + 1);
                            $(this).attr("id", newId);
                        }
                        if (oldfor) {
                            let newFor = oldfor.replace(/\d+/, repeaterIndex + 1);
                            $(this).attr("for", newFor);
                        }
                    });
                    repeatHtml.find('#' + (repeaterIndex + 1) + 'position').val('0');
                    repeatHtml.find('#' + (repeaterIndex + 1) + 'field_id').val('0');
                    repeatHtml.find('#' + (repeaterIndex + 1) + 'oldname').val('');

                    repeaterIndex = repeaterIndex + 1;

                    $('#repeater-container').append(repeatHtml);
                } else {
                    toastr.info(`👋 This Feild Not Duplicated!`,
                        'Not Duplicated', {
                            closeButton: true,
                            tapToDismiss: false
                        });
                }
            });
        });
    </script>
@endsection
<!-- END: Java Script-->
