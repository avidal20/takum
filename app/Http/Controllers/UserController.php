<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idCategory = 0)
    {
        $client = new ApiGetController();
        
        $categories = $client->getCategories();
        
        $categories = array_filter($categories, function($item){
            if($item['state'] == 1){
                return true;
            }else{
                return false;
            }
        });

        $categories = array_values($categories);


        $products = [];

        if(count($categories) > 0 && $idCategory == 0){

          $idCategory = $categories[0]['id'];
          $products = $client->getProducts($idCategory);

            $products = array_filter($products, function($item){
                if($item['state'] == 1){
                    return $item;
                }else{
                    unset($item);
                    return;
                }
            });

        }else{
          
          $category = $client->showCategory($idCategory);
          
          if(count($category) > 0){

            $products = $client->getProducts($idCategory);
            $products = array_filter($products, function($item){
                if($item['state'] == 1){
                    return $item;
                }else{
                    unset($item);
                    return;
                }
            });

            
          }

        }

        return view('user.index',compact('categories','idCategory','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
