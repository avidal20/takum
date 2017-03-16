@extends('layouts.appUser')

@section('content')
<div class="container">
    <div class="row">


          <div class="col-md-3">
              <p class="lead">@lang('modules.module_gp_table_category')</p>
              <div class="list-group">
                @if(count($categories) > 0)
                  @foreach($categories as $category)
                    @if($category['state'] == 1)
                      <a href="{{ route('home_user', ['idCategory' => $category['id'] ]) }}" class="list-group-item @if($idCategory == $category['id']) active @endif">{{ $category['name_'.config('app.locale')] }}</a>
                    @else
                      <p>@lang('modules.module_gp_category_msj_not_resource')</p>
                      @break
                    @endif
                  @endforeach
                @else
                  <p>@lang('modules.module_gp_category_msj_not_resource')</p>
                @endif
              </div>
          </div>

          <div class="col-md-9">
            <p class="lead">@lang('modules.module_gp_table_btn_products')</p>
              <div class="row">
              
                @if(count($products) > 0 )
                  @foreach($products as $product)
                    @if($product['state'] == 1 && $product['category']['state'] == 1)
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3><a href="#">{{ str_limit($product['name_'.config('app.locale')],15) }}</a></h3>
                                <strong>${{ number_format($product['price'], 2) }}</strong>
                                <p>{{ str_limit($product['description_'.config('app.locale')], 80) }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                  @endforeach
                @else
                  <p>@lang('modules.module_gp_product_msj_not_resource')</p>
                @endif
              </div>

          </div>

    </div>
</div>
@endsection
