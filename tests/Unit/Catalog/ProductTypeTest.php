<?php

namespace Tests\Unit\Catalog;

use App\Catalog\Product;
use App\Catalog\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTypeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a catalog product type can be created
     *
     * @return  void
     */
    public function testItCanCreateAProductType()
    {
        $data = [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->text,
        ];

        $productType = factory(ProductType::class)->create($data);

        $this->assertInstanceOf(ProductType::class, $productType);
        $this->assertDatabaseHas($productType->getTable(), $data);
    }

    /**
     * Test that a catalog product type can be updated
     *
     * @return  void
     */
    public function testItCanUpdateAProductType()
    {
        $name = $this->faker->words(2, true);
        $productType = factory(ProductType::class)->create();
        $productType->name = $name;
        $productType->save();

        $this->assertDatabaseHas($productType->getTable(), ['id' => $productType->id, 'name' => $name]);
    }

    /**
     * Test that a catalog product type can be deleted
     *
     * @return  void
     */
    public function testItCanDeleteAProductType()
    {
        $productType = factory(ProductType::class)->create();
        $productTypeData = $productType->toArray();
        $productTypeTable = $productType->getTable();

        $this->assertDatabaseHas($productTypeTable, $productTypeData);

        $productType->delete();

        $this->assertDatabaseMissing($productTypeTable, $productTypeData);
    }

    /**
     * Test that a catalog product type can get its related products
     *
     * @return  void
     */
    public function testItCanGetProductsFromAProductType()
    {
        $productType = factory(ProductType::class)->create();
        $productCount = rand(20, 40);

        for ($i = 0; $i < $productCount; $i++) {
            factory(Product::class)->create(['product_type_id' => $productType->id]);
        }

        $products = $productType->products;

        $this->assertEquals($productCount, count($products));
        $this->assertInstanceOf(Collection::class, $products);
    }
}
