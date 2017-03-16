<?php

namespace App\Http\Controllers\Products\Api;

use Validator;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class ProductCategoryController extends Controller
{

    public function valid($request){
      //Validaciones
      $validator =  Validator::make($request->all(), [
         'name_en' => 'required|max:255',
         'name_fr' => 'required|max:255',
         'description_en' => 'required|max:500',
         'description_fr' => 'required|max:500',
         'state' => 'required|Numeric'
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
    public function index()
    {
        try {

          $categories = ProductCategory::with('products')->get();

          return response(array(
                  'error' => false,
                  'status' => true,
                  'message' => '',
                  'data' => [
                    'categories' => $categories,
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
      if (!$request->has('name_en','name_fr','description_en','description_fr','state')){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'Incorrect structure',
              ),500);
      }

      //Validaciones
      $this->valid($request);

        try {

            $category = new ProductCategory([
                'name_en' => $request->name_en,
                'name_fr' => $request->name_fr,
                'description_en' => $request->description_en,
                'description_fr' => $request->description_fr,
                'state' => $request->state,
            ]);

            $category->save();

            return response(array(
                    'error' => false,
                    'status' => true,
                    'message' => 'Category created successfully',
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

        $category = ProductCategory::with('products')->find($id);

        if(is_null($category)){
          return response(array(
                  'error' => true,
                  'status' => false,
                  'message' => 'This category does not exits',
                  'data' => [
                    'category' => $category,
                    ]
                 ),404);
        }

        return response(array(
                'error' => false,
                'status' => true,
                'message' => '',
                'data' => [
                  'category' => $category,
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

      // si la estructura es incorrecta
      if (!$request->has('name_en','name_fr','description_en','description_fr','state')){
        return response(array(
                'error' => true,
                'status' => false,
                'message' => $request->all(),
              ),500);
      }

      //Validaciones
      $this->valid($request);

        try {

            $product = ProductCategory::find($id);
              $product->name_en = $request->name_en;
              $product->name_fr = $request->name_fr;
              $product->description_en = $request->description_en;
              $product->description_fr = $request->description_fr;
              $product->state = $request->state;
            $product->save();

            return response(array(
                    'error' => false,
                    'status' => true,
                    'message' => 'Category Updated successfully',
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
    public function destroy($id){

      try {

        $category = ProductCategory::find($id);
        if(is_null($category)){
          return response(array(
                  'error' => true,
                  'status' => false,
                  'message' => 'This category does not exits',
                  'data' => [
                    'product' => $category,
                    ]
                 ),404);
        }

        $category->delete();

        return response(array(
                'error' => false,
                'status' => true,
                'message' => 'Category removed',
               ),200);

      } catch (QueryException $e) {

        return response(array(
                'error' => true,
                'status' => false,
                'message' => 'The category has associated products',
              ),500);
      }

    }

}
