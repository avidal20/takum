<?php

namespace App\Http\Controllers\Products\Api;

use Validator;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{

    public function valid($request){
      //Validaciones
      $validator =  Validator::make($request->all(), [
         'name_en' => 'required|max:255',
         'name_fr' => 'required|max:255',
         'description_en' => 'required|max:500',
         'description_fr' => 'required|max:500',
         'state' => 'required|Numeric',
         'price' => 'required|Numeric',
         'id_category' => 'required|Numeric'
     ]);

     return response(array(
             'error' => true,
             'status' => false,
             'message' => $validator->errors()->all(),
           ),500);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCategory)
    {

        try {

          $products = Product::with('category')->where('id_category', $idCategory)->get();

          return response(array(
                  'error' => false,
                  'status' => true,
                  'message' => '',
                  'data' => [
                    'products' => $products,
                    ]
                 ),200);

        } catch (QueryException $e) {

          return response(array(
                  'error' => true,
                  'status' => false,
                  'message' => 'The server does not respond',
                ),500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // si la estructura es incorrecta
      if (!$request->has('name_en','name_fr','description_en','description_fr','state','price','id_category')){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'Incorrect structure',
              ),500);
      }

      //Validaciones
      $this->valid($request);

      //Valida el ID de la categoria
      $category = ProductCategory::find($request->id_category);
      if(is_null($category)){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'Category id - '.$request->id_category.' is not registered',
              ),404);
      }

        try {

            $product = new Product([
                'name_en' => $request->name_en,
                'name_fr' => $request->name_fr,
                'description_en' => $request->description_en,
                'description_fr' => $request->description_fr,
                'state' => $request->state,
                'price' => $request->price,
                'id_category' => $request->id_category,
            ]);

            $product->save();

            return response(array(
                    'error' => false,
                    'status' => true,
                    'message' => 'Product created successfully',
                  ),200);

        } catch (QueryException $e) {

            return response(array(
                    'error' => true,
                    'status' => false,
                    'message' => 'The server does not respond',
                  ),500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      try {

        $product = Product::with('category')->find($id);

        if(is_null($product)){
          return response(array(
                  'error' => true,
                  'status' => false,
                  'message' => 'This product does not exits',
                  'data' => [
                    'product' => $product,
                    ]
                 ),404);
        }

        return response(array(
                'error' => false,
                'status' => true,
                'message' => '',
                'data' => [
                  'product' => $product,
                  ]
               ),200);

      } catch (QueryException $e) {

        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'The server does not respond',
              ),500);
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      //Si el producto no existe
      $product = Product::find($id);
      if(is_null($product)){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'This product does not exits',
                'data' => [
                  'product' => $product,
                  ]
               ),404);
      }

      // si la estructura es incorrecta
      if (!$request->has('name_en','name_fr','description_en','description_fr','state','price','id_category')){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => $request->all(),
              ),500);
      }

      //Validaciones
      $this->valid($request);

      //Valida el ID de la categoria
      $category = ProductCategory::find($request->id_category);
      if(is_null($category)){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'Category id - '.$request->id_category.' is not registered',
              ),404);
      }

        try {

            $product = Product::find($id);
              $product->name_en = $request->name_en;
              $product->name_fr = $request->name_fr;
              $product->description_en = $request->description_en;
              $product->description_fr = $request->description_fr;
              $product->state = $request->state;
              $product->price = $request->price;
              $product->id_category = $request->id_category;
            $product->save();

            return response(array(
                    'error' => false,
                    'status' => true,
                    'message' => 'Product Updated successfully',
                  ),200);

        } catch (QueryException $e) {

            return response(array(
                    'error' => true,
                    'status' => false,
                    'message' => 'The server does not respond',
                  ),500);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      try {

        $product = Product::find($id);

        if(is_null($product)){
          return response(array(
                  'error' => true,
                  'status' => false,
                  'message' => 'This product does not exits',
                  'data' => [
                    'product' => $product,
                    ]
                 ),404);
        }

        $product->delete();

        return response(array(
                'error' => false,
                'status' => true,
                'message' => 'Product removed',
               ),200);

      } catch (QueryException $e) {

        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'The server does not respond',
              ),500);
      }

    }
}
