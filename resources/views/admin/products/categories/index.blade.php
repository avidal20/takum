@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('category.create') }}" class="btn btn-default">@lang('modules.module_gp_btn_new_category')</a>

            <h1>@lang('modules.module_gp_title')</h1>

            <ul class="breadcrumb">
              <li>@lang('modules.module_gp_breadcrum_home')</li>
              <li class="active">@lang('modules.module_gp_table_category')</li>
            </ul>

            <h2>@lang('modules.module_gp_table_category')</h2>

            @include('helpers.alerts')

            <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>@lang('modules.module_gp_table_field_title')</th>
                    <th>@lang('modules.module_gp_table_field_description')</th>
                    <th>@lang('modules.module_gp_table_field_state')</th>
                    <th>@lang('modules.module_gp_table_field_accions')</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category['name_'.config('app.locale')] }}</td>
                        <td>{{ str_limit($category['description_'.config('app.locale')], 80) }}</td>
                        <td>@if($category['state'] == "1") @lang('modules.module_gp_table_field_state_active') @else  @lang('modules.module_gp_table_field_state_inactive') @endif </td>
                        <td>
                            <a href="{{ route('category.edit',['id' => $category['id']]) }}" class="btn btn-default">@lang('modules.module_gp_table_btn_edit')</a>
                            <a href="{{ route('category.show',['id' => $category['id']]) }}" class="btn btn-default">@lang('modules.module_gp_table_btn_remove')</a>
                            <a href="{{ route('products.index',['idCategory' => $category['id']]) }}" class="btn btn-default">@lang('modules.module_gp_table_btn_products') ( {{ count($category['products']) }} )</a>
                        </td>
                  </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
