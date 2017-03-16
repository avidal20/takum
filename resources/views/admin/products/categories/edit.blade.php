@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('home') }}" class="btn btn-default">@lang('modules.cms_to_return')</a>

            <h1>@lang('modules.module_gp_title')</h1>

            <ul class="breadcrumb">
              <li class="active"><a href="{{ route('home') }}">@lang('modules.module_gp_breadcrum_home')</a></li>
              <li>@lang('modules.module_gp_btn_edit_category')</li>
            </ul>

            <h2>@lang('modules.module_gp_btn_edit_category')</h2>

            @include('helpers.alerts')

    <form class="form-horizontal" method="post" action="{{ route('category.update',['id' => $category['id']]) }}">

        <fieldset>

        <!-- Form Name -->
        <legend>@lang('modules.module_gp_frm_info')</legend>

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="name_en">@lang('modules.module_gp_table_field_title') *</label>
          <div class="col-md-4">
          <input name="name_en" id="name_en" type="text" placeholder="Language: Es" class="form-control" required="required" maxlength="255" value="{{ $category['name_en'] }}">
          <input name="name_fr" type="text" placeholder="Language: Fr" class="form-control" required="required" maxlength="255" value="{{ $category['name_fr'] }}">
          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="description_en">@lang('modules.module_gp_table_field_description') *</label>
          <div class="col-md-4">
            <textarea class="form-control" name="description_en" id="description_en" placeholder="Language: Es" required="required" maxlength="500">{{ $category['description_en'] }}</textarea>
            <textarea class="form-control" name="description_fr" required="required" placeholder="Language: Fr" maxlength="500">{{ $category['description_fr'] }}</textarea>
          </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="state">@lang('modules.module_gp_table_field_state') *</label>
          <div class="col-md-4">
            <select name="state" class="form-control" id="state" required="required">
              <option value="1" {{ $category['state'] == "1" ? "selected" : "" }}>@lang('modules.module_gp_table_field_state_active')</option>
              <option value="2" {{ $category['state'] == "2" ? "selected" : "" }}>@lang('modules.module_gp_table_field_state_inactive')</option>
            </select>
          </div>
        </div>

        <div class="col-md-12 text-center">
          <button id="button" name="button" onclick="return confirm('@lang('modules.module_gp_msj_modify')');" class="btn btn-primary">@lang('modules.module_gp_btn_modify')</button>
        </div>

        </fieldset>

    </form>

<hr>

        </div>
    </div>
</div>
@endsection
