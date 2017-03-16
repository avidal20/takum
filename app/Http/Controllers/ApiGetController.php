<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiGetController extends Controller
{
   	var $client;

    public function __construct()
	{
		$this->client = new Client(['http_errors' => false]);
	}

	public function getCategories(){

		$response = $this->client->get(
			route('api.products.category.index')
		);

		$arry = json_decode($response->getBody(), true);


		if(isset($arry['data']['categories'])){
			$categories = $arry['data']['categories'];
		}else{
			$arry['data']['categories'] = [];
			$categories = $arry['data']['categories'];
		}

		return $categories;
	}

  public function getProducts($idCategory){

		$response = $this->client->get(
			route('api.products.index',['idCategory' => $idCategory ])
		);

		$arry = json_decode($response->getBody(), true);

    $categories = $arry['data']['products'];

		return $categories;

	}

	public function storeCategory($request){

		$response = $this->client->post(route('api.products.category.store'), [
		    'form_params' => [

		        'name_en' => $request->name_en,
		        'name_fr' => $request->name_fr,
		        'description_en' => $request->description_en,
		        'description_fr' => $request->description_fr,
		        'state' => $request->state,

		    ]
		]);

		$arry = json_decode($response->getBody(), true);

		return $arry['error'];

	}

  public function storeProduct($request, $idCategory){

		$response = $this->client->post(route('api.products.store'), [
		    'form_params' => [
		        'name_en' => $request->name_en,
		        'name_fr' => $request->name_fr,
		        'description_en' => $request->description_en,
		        'description_fr' => $request->description_fr,
		        'state' => $request->state,
		        'price' => $request->price,
		        'id_category' => $idCategory,
		    ]
		]);

		$arry = json_decode($response->getBody(), true);

		return $arry['error'];

	}

	public function showCategory($id){

		$response = $this->client->get(
			route('api.products.category.show',['id' => $id])
		);

		$arry = json_decode($response->getBody(), true);

		if(isset($arry['data']['category'])){
			$category = $arry['data']['category'];
		}else{
			$arry['data']['category'] = [];
			$category = $arry['data']['category'];
		}

		return $category;
	}

  public function showProduct($id){

		$response = $this->client->get(
			route('api.products.show',['id' => $id])
		);

		$arry = json_decode($response->getBody(), true);

		return $arry['data']['product'];
	}

	public function updateProduct($request, $idCategory, $id){

		$response = $this->client->put(
			route('api.products.update',['id' => $id]
			), [
		    'form_params' => [
		        'name_en' => $request->name_en,
		        'name_fr' => $request->name_fr,
		        'description_en' => $request->description_en,
		        'description_fr' => $request->description_fr,
		        'state' => $request->state,
            'price' => $request->price,
		        'id_category' => $idCategory,
		    ]
		]);

		$arry = json_decode($response->getBody(), true);

		return $arry['error'];

	}

  public function updateCategory($request, $id){

		$response = $this->client->put(
			route('api.products.category.update',['id' => $id]
			), [
		    'form_params' => [
		        'name_en' => $request->name_en,
		        'name_fr' => $request->name_fr,
		        'description_en' => $request->description_en,
		        'description_fr' => $request->description_fr,
		        'state' => $request->state,
		    ]
		]);

		$arry = json_decode($response->getBody(), true);

		return $arry['error'];

	}

	public function destroyCategory($id){

		$response = $this->client->delete(
			route('api.products.category.destroy',['id' => $id])
		);
		
		$arry = json_decode($response->getBody(), true);


		return $arry['error'];

	}

  public function destroyProduct($id){

		$response = $this->client->delete(
			route('api.products.destroy',['id' => $id])
		);

		$arry = json_decode($response->getBody(), true);

		return $arry['error'];

	}

}
