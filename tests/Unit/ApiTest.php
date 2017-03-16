<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApiTest extends TestCase
{

    /**
     * Products
     *
     * */

    public function testCategoryIndex()
    {
        $response = $this->call('GET', route('api.products.category.index') );
    	
    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    public function testCategoryStore(){

        $response = $this->json('POST', route('api.products.category.store'),[
         	'name_en' => 'name_en_test',
            'name_fr' =>'name_fr_test',
            'description_en' => 'description_en_test',
            'description_fr' => 'description_fr_test',
            'state' => '1',
         ]);

        $response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);

    }

    public function testCategoryShow(){
    	
    	$response = $this->call('GET', route('api.products.category.show',['id' => \DB::table('md_products_categories')->max('id')]) );

    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    public function testCategoryUpdate(){
    	$response = $this->call('PUT', route('api.products.category.update',['id' => \DB::table('md_products_categories')->max('id')]),[
         	'name_en' => 'name_en_test_update',
            'name_fr' =>'name_fr_test_update',
            'description_en' => 'description_en_test_update',
            'description_fr' => 'description_fr_test_update',
            'state' => '2',
         ]);

    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    public function testCategoryDestroy(){
    	$response = $this->call('DELETE', route('api.products.category.destroy',['id' => \DB::table('md_products_categories')->max('id')]));
    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    /**
     * Categories
     *
     * */

    public function testProductIndex()
    {
        $response = $this->call('GET', route('api.products.index',['idCategory' => \DB::table('md_products_categories')->max('id')]) );
    	
    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    public function testProductStore(){

        $response = $this->json('POST', route('api.products.store',['idCategory' => \DB::table('md_products_categories')->max('id')]),[
         	'name_en' => 'name_en_test',
            'name_fr' =>'name_fr_test',
            'description_en' => 'description_en_test',
            'description_fr' => 'description_fr_test',
            'state' => '1',
            'price' => '10000000',
            'id_category' => \DB::table('md_products_categories')->max('id'),
         ]);

        $response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);

    }

    public function testProductShow(){
    	
    	$response = $this->call('GET', route('api.products.show',['idCategory' => \DB::table('md_products')->max('id')]) );

    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    public function testProductUpdate(){
    	 $response = $this->json('PUT', route('api.products.update',['id' => \DB::table('md_products')->max('id')]),[
         	'name_en' => 'name_en_test_update',
            'name_fr' =>'name_fr_test_update',
            'description_en' => 'description_en_test_update',
            'description_fr' => 'description_fr_test_update',
            'state' => '1',
            'price' => '10000000',
            'id_category' => \DB::table('md_products_categories')->max('id'),
         ]);

    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

    public function testProductDestroy(){
    	$response = $this->call('DELETE', route('api.products.destroy',['id' => \DB::table('md_products')->max('id')]));
    	$response
	        ->assertStatus(200)
	        ->assertJson([
                'status' => true,
	        ]);
    }

}
