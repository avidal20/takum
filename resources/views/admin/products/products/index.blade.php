@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <a href="{{ route('home') }}" class="btn btn-default">@lang('modules.cms_to_return')</a>


            <a href="{{ route('products.create',['idCategory' => $category['id'] ]) }}" class="btn btn-default">@lang('modules.module_gp_btn_new_products')</a>

            <h1>@lang('modules.module_gp_title')</h1>

            <ul class="breadcrumb">
              <li><a href="{{ route('home') }}">@lang('modules.module_gp_breadcrum_home')</a></li>
              <li class="active">@lang('modules.module_gp_table_products') - {{ $category['name_'.config('app.locale')] }} </li>
            </ul>

            <h2>@lang('modules.module_gp_table_products')  - {{ $category['name_'.config('app.locale')] }} </h2>

            @include('helpers.alerts')

            <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>@lang('modules.module_gp_products_table_field_title')</th>
                    <th>@lang('modules.module_gp_products_table_field_description')</th>
                    <th>@lang('modules.module_gp_products_table_field_price')</th>
                    <th>@lang('modules.module_gp_products_table_field_state')</th>
                    <th>@lang('modules.module_gp_products_table_field_accions')</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product['name_'.config('app.locale')] }}</td>
                        <td>{{ str_limit($product['description_'.config('app.locale')], 80) }}</td>
                        <td>$ {{ number_format($product['price'],2) }}</td>
                        <td>@if($product['state'] == "1") @lang('modules.module_gp_products_table_field_state_active') @else  @lang('modules.module_gp_products_table_field_state_inactive') @endif </td>
                        <td>
                            <a href="{{ route('products.edit',['idCategory' => $category['id'] ,'id' => $product['id']]) }}" class="btn btn-default">@lang('modules.module_gp_products_table_btn_edit')</a>
                            <a href="{{ route('products.show',['idCategory' => $category['id'] ,'id' => $product['id']]) }}" class="btn btn-default">@lang('modules.module_gp_products_table_btn_remove')</a>
                        </td>
                  </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
