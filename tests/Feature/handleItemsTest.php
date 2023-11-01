<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class handleItemsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */

    private Product|Collection $product;

    protected function setUp(): void
    {
        //arrange
        parent::setUp();
        $this->product = $this->createProducts();
    }

    public function test_return_view_products_list(): void
    {
        //act
        $response = $this->getJson('/');

        //assert
        $response->assertStatus(200);

    }


    public function test_api_returns_a_json_response(): void
    {
        //act
        $response = $this->getJson('api/products');

        //assert
        $response->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
            ->where('products.0.name',$this->product->toArray()[0]['name'])
            ->where('products.0.description',$this->product->toArray()[0]['description'])
            ->where('products.1.name',$this->product->toArray()[1]['name'])
            ->where('products.1.description',$this->product->toArray()[1]['description'])
        );
    }

    public function test_api_returns_a_asc_response_by_name() : void
    {

        //act
        $response = $this->getJson(route('api.products',
            ['orderBy' => 'name',
            'direction' => 'asc']));

        //$assert
        $response
            ->assertOk()
            ->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('products.0.name','abc')
                ->where('products.2.name','cbc')
            );

    }

    public function test_api_returns_a_desc_response_by_name() : void
    {

        //act
        $response = $this->getJson(route('api.products',
            ['orderBy' => 'name',
            'direction' => 'desc']));

        //$assert
        $response
            ->assertOk()
            ->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('products.0.name','cbc')
                ->where('products.2.name','abc')
            );

    }

    public function test_api_returns_a_asc_response_by_price() : void
    {
        //act
        $response = $this->getJson(route('api.products',
            ['orderBy' => 'price',
                'direction' => 'asc']));

        //assert
        $response
            ->assertOk()
            ->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('products.0.price',1000)
                ->where('products.2.price',3000)
            );

    }

    public function test_api_returns_a_desc_response_by_price() : void
    {
        //act
        $response = $this->getJson(route('api.products',
            ['orderBy' => 'price',
                'direction' => 'desc']));

        //assert
        $response
            ->assertOk()
            ->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('products.0.price',3000)
                ->where('products.2.price',1000)
            );

    }

    public function test_api_returns_a_asc_response_by_category() :void
    {
        //act
        $response = $this->getJson(route('api.products',
            ['orderBy' => 'category',
                'direction' => 'asc']));

        //assert
        $response
            ->assertOk()
            ->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('products.0.category.name','abc')
                ->where('products.2.category.name','cbc')
            );

    }
 public function test_api_returns_a_desc_response_by_category() :void
    {
        //act
        $response = $this->getJson(route('api.products',
            ['orderBy' => 'category',
                'direction' => 'asc']));

        //assert
        $response
            ->assertOk()
            ->assertJsonStructure(['products'])
            ->assertJson(fn(AssertableJson $json) => $json
                ->where('products.0.category.name','cbc')
                ->where('products.2.category.name','abc')
            );

    }


    /**
     * @return Product|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    private function createProducts(): Product|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
    {
        return Product::factory(3)
            ->sequence(
                [
                    'name' => 'abc',
                    'price' => 1000,
                    'category_id' => Category::factory()->create([
                        'name' => 'abc'
                    ])
                ],
                [
                    'name' => 'bbc',
                    'price' => 2000,
                    'category_id' => Category::factory()->create([
                        'name' => 'bbc'
                    ])
                ],
                [
                    'name' => 'cbc',
                    'price' => 3000,
                    'category_id' => Category::factory()->create([
                        'name' => 'cbc'
                    ])
                ]
            )
            ->create();
    }

}

