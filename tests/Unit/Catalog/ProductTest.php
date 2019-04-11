<?php

namespace Tests\Unit\Catalog;

use App\Catalog\Category;
use App\Catalog\Product;
use App\Catalog\Product\AttributeTemplate;
use App\Catalog\Product\AttributeValue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a catalog product can be created
     *
     * @return  void
     */
    public function testItCanCreateAProduct()
    {
        $data = [
            'name' => $this->faker->words(2, true),
        ];

        $product = factory(Product::class)->create($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas($product->getTable(), $data);
    }

    /**
     * Test that a catalog product can be updated
     *
     * @return  void
     */
    public function testItCanUpdateAProduct()
    {
        $name = $this->faker->words(2, true);
        $product = factory(Product::class)->create();
        $product->name = $name;
        $product->save();

        $this->assertDatabaseHas($product->getTable(), ['id' => $product->id, 'name' => $name]);
    }

    /**
     * Test that a catalog product can be deleted
     *
     * @return  void
     */
    public function testItCanDeleteAProduct()
    {
        $product = factory(Product::class)->create();
        $productData = $product->toArray();
        $productTable = $product->getTable();

        $this->assertDatabaseHas($productTable, $productData);

        $product->delete();

        $this->assertDatabaseMissing($productTable, $productData);
    }

    /**
     * Test that a catalog product can get its related attribute template
     *
     * @return  void
     */
    public function testItCanGetAProductAttributeTemplateFromAProduct()
    {
        $product = factory(Product::class)->create();
        $attributeTemplate = $product->attributeTemplate;

        $this->assertInstanceOf(AttributeTemplate::class, $attributeTemplate);
        $this->assertEquals($product->attribute_template_id, $attributeTemplate->id);
    }

    /**
     * Test that a catalog product can get its attribute values
     *
     * @return  void
     */
    public function testItCanGetProductAttributesWithValuesFromAProduct()
    {
        $product = factory(Product::class)->create();
        $attributeCount = rand(3, 12);

        for ($i = 0; $i < $attributeCount; $i++) {
            factory(AttributeValue::class)->create(['product_id' => $product->id]);
        }

        $attributes = $product->attributes;

        $this->assertEquals($attributeCount, count($attributes));
        $this->assertInstanceOf(Collection::class, $attributes);
    }

    /**
     * Test that a catalog product can get its related categories
     *
     * @return  void
     */
    public function testItCanGetCategoriesFromAProduct()
    {
        $product = factory(Product::class)->create();

        $categoryCount = rand(3, 12);

        for ($i = 0; $i < $categoryCount; $i++) {
            factory(Category::class)->create()->products()->attach($product);
        }

        $categories = $product->categories;

        $this->assertInstanceOf(Collection::class, $categories);
        $this->assertEquals($categoryCount, $categories->count());
    }
}
