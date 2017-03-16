<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Http\Controllers\ApiGetController;
use Illuminate\Support\Facades\Session;
use Lang;

class CategoryController extends Controller
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
    public function index()
    {
		$client = new ApiGetController();
		$categories = $client->getCategories();
  		return view('admin.products.categories.index', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
  		return view('admin.products.categories.create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
	        'name_en' => 'required|max:255',
	        'name_fr' => 'required|max:255',
	        'description_en' => 'required|max:500',
			'description_fr' => 'required|max:500',
     		'state' => 'required|Numeric'
     	]);

   	    $client = new ApiGetController();
		$categories = $client->storeCategory($request);

		if($categories){
			Session::flash('error',Lang::get('modules.module_gp_msj_error_store'));
		}else{
			Session::flash('success',Lang::get('modules.module_gp_msj_sucess_store'));
		}

		return redirect()->route('home');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    	$client = new ApiGetController();
		$category = $client->showCategory($id);
        
		if(count($category) == 0){
            Session::flash('error',Lang::get('modules.module_gp_msj_not_item'));
			return redirect()->route('home');
		}

  		return view('admin.products.categories.edit', compact('category'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    	$this->validate($request, [
	        'name_en' => 'required|max:255',
	        'name_fr' => 'required|max:255',
	        'description_en' => 'required|max:500',
			'description_fr' => 'required|max:500',
     		'state' => 'required|Numeric'
     	]);

    	$client = new ApiGetController();
			$category = $client->showCategory($id);

			if(count($category) == 0){
	      Session::flash('success',Lang::get('modules.module_gp_msj_not_item'));
				return redirect()->route('home');
			}

			$category = $client->updateCategory($request, $id);

			if($category){
				Session::flash('error', Lang::get('modules.module_gp_msj_error_update'));
			}else{
				Session::flash('success', Lang::get('modules.module_gp_msj_sucess_update'));
			}

		return redirect()->route('home');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    	$client = new ApiGetController();
			$category = $client->showCategory($id);

		if(count($category) == 0){
            Session::flash('error', Lang::get('modules.module_gp_msj_not_item'));
			return redirect()->route('home');
		}

  		return view('admin.products.categories.show', compact('category'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$client = new ApiGetController();
		$category = $client->showCategory($id);


		if(count($category) == 0){
            Session::flash('error',Lang::get('modules.module_gp_msj_not_item'));
			return redirect()->route('home');
		}

		$arry = $client->destroyCategory($id);

		if($arry){
    	    Session::flash('error',Lang::get('modules.module_gp_msj_error_destroy'));
    	    return view('admin.products.categories.show', compact('category'));
		}else{
    	    Session::flash('success',Lang::get('modules.module_gp_msj_sucess_destroy'));
    	    return redirect()->route('home');
		}

    }

}
