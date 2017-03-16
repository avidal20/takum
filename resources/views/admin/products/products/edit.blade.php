@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('products.index',['idCategory' => $category['id'] ]) }}" class="btn btn-default">@lang('modules.cms_to_return')</a>

            <h1>@lang('modules.module_gp_title')</h1>

            <ul class="breadcrumb">
              <li><a href="{{ route('home') }}">@lang('modules.module_gp_breadcrum_home')</a></li>
              <li><a href="{{ route('products.index',['idCategory' => $category['id'] ]) }}">@lang('modules.module_gp_table_products') - {{ $category['name_'.config('app.locale')]}}</a></li>
              <li class="active">@lang('modules.module_gp_btn_edit_products')</li>
            </ul>

            <h2>@lang('modules.module_gp_btn_edit_products')</h2>

            @include('helpers.alerts')

    <form class="form-horizontal" method="post" action="{{ route('products.update',['idCategory' => $category['id'], 'id' => $product['id'] ]) }}">

        <fieldset>
        <!-- Form Name -->
        <legend>@lang('modules.module_gp_frm_info')</legend>

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="name_en">@lang('modules.module_gp_products_table_field_title') *</label>
          <div class="col-md-4">
          <input name="name_en" value="{{ $product['name_en'] }}" id="name_en" type="text" placeholder="Language: Es" class="form-control" required="required" maxlength="255">
          <input name="name_fr" value="{{ $product['name_fr'] }}" type="text" placeholder="Language: Fr" class="form-control" required="required" maxlength="255">
          </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="description_en">@lang('modules.module_gp_products_table_field_description') *</label>
          <div class="col-md-4">
            <textarea class="form-control" name="description_en" id="description_en" placeholder="Language: Es" required="required" maxlength="500">{{ $product['description_en'] }}</textarea>
            <textarea class="form-control" name="description_fr" required="required" placeholder="Language: Fr" maxlength="500">{{ $product['description_fr'] }}</textarea>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="price">@lang('modules.module_gp_products_table_field_price') *</label>
          <div class="col-md-4">
          <input name="price" id="price" type="number" value="{{ $product['price'] }}" class="form-control" required="required" min="1" step="any">
          </div>
        </div>


        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="state">@lang('modules.module_gp_products_table_field_state') *</label>
          <div class="col-md-4">
            <select name="state" class="form-control" id="state" required="required">
              <option value="1" {{ $product['state'] == "1" ? "selected" : "" }}>@lang('modules.module_gp_products_table_field_state_active')</option>
              <option value="2" {{ $product['state'] == "2" ? "selected" : "" }}>@lang('modules.module_gp_products_table_field_state_inactive')</option>
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
