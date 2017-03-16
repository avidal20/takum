<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Http\Controllers\ApiGetController;
use Illuminate\Support\Facades\Session;
use Lang;


class ProductsController extends Controller
{

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCategory)
    {

      $client = new ApiGetController();

      $products = $client->getProducts($idCategory);

      $category = $client->showCategory($idCategory);

      if(count($category) == 0){
        Session::flash('success',Lang::get('modules.module_gp_msj_not_item'));
				return redirect()->route('home');
			}

      return view('admin.products.products.index', compact('products','category'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($idCategory)
    {
      $client = new ApiGetController();
      $category = $client->showCategory($idCategory);

      if(count($category) == 0){
        Session::flash('success',Lang::get('modules.module_gp_msj_not_item'));
				return redirect()->route('home');
			}

      return view('admin.products.products.create', compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idCategory)
    {
        $client = new ApiGetController();
        $category = $client->showCategory($idCategory);

        if(count($category) == 0){
          Session::flash('success',Lang::get('modules.module_gp_msj_not_item'));
          return redirect()->route('home');
        }

        $this->validate($request, [
            'name_en' => 'required|max:255',
            'name_fr' => 'required|max:255',
            'description_en' => 'required|max:500',
            'description_fr' => 'required|max:500',
            'state' => 'required|Numeric',
            'price' => 'required|Numeric',
       	]);

       	$client = new ApiGetController();
    		$res = $client->storeProduct($request, $idCategory);

    		if($res){
    			Session::flash('error',Lang::get('modules.module_gp_product_msj_error_store'));
    		}else{
    			Session::flash('success',Lang::get('modules.module_gp_product_msj_sucess_store'));
    		}

		    return redirect()->route('products.index',['idCategory' => $idCategory]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idCategory, $id)
    {
        $client = new ApiGetController();
        $category = $client->showCategory($idCategory);
        $product = $client->showProduct($id);

        if(count($category) == 0){
          Session::flash('error', Lang::get('modules.module_gp_msj_not_item'));
          return redirect()->route('home');
        }

        return view('admin.products.products.show', compact('category','product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idCategory, $id)
    {

      $client = new ApiGetController();

      $category = $client->showCategory($idCategory);
      $product = $client->showProduct($id);

      if(count($category) == 0){
        Session::flash('success',Lang::get('modules.module_gp_msj_not_item'));
        return redirect()->route('home');
      }

      return view('admin.products.products.edit', compact('category','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idCategory, $id)
    {
      $client = new ApiGetController();
      $category = $client->showCategory($idCategory);

      if(count($category) == 0){
        Session::flash('success',Lang::get('modules.module_gp_msj_not_item'));
        return redirect()->route('home');
      }

      $this->validate($request, [
          'name_en' => 'required|max:255',
          'name_fr' => 'required|max:255',
          'description_en' => 'required|max:500',
          'description_fr' => 'required|max:500',
          'state' => 'required|Numeric',
          'price' => 'required|Numeric',
      ]);

      $client = new ApiGetController();
      $res = $client->updateProduct($request, $idCategory, $id);

      if($res){
        Session::flash('error',Lang::get('modules.module_gp_product_msj_error_update'));
        return redirect()->route('products.edit',['idCategory' => $idCategory ,'id' => $id]);
      }else{
        Session::flash('success',Lang::get('modules.module_gp_product_msj_sucess_update'));
      }

      return redirect()->route('products.index',['idCategory' => $idCategory]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idCategory, $id)
    {
        $client = new ApiGetController();
        $category = $client->showCategory($idCategory);
        $product = $client->showProduct($id);

        if(count($category) == 0){
          Session::flash('error',Lang::get('modules.module_gp_msj_not_item'));
          return redirect()->route('home');
        }

        $arry = $client->destroyProduct($id);

        if($arry){
          Session::flash('error',Lang::get('modules.module_gp_product_msj_error_destroy'));
          return view('admin.products.products.show', compact('category','product'));
        }else{
          Session::flash('success',Lang::get('modules.module_gp_product_msj_sucess_destroy'));
          return redirect()->route('products.index',['idCategory' => $idCategory]);
        }
    }
}
