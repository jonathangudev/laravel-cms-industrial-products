<?php

namespace Tests\Unit\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use App\Catalog\Product\AttributeSet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeSetTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a catalog product attribute set can be created
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanCreateAnAttributeSet()
    {
        $data = [
            'name' => $this->faker->words(2, true),
        ];

        $attributeSet = factory(AttributeSet::class)->create($data);

        $this->assertInstanceOf(AttributeSet::class, $attributeSet);
        $this->assertDatabaseHas($attributeSet->getTable(), $data);
    }

    /**
     * Test that a catalog product attribute set can be updated
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanUpdateAnAttributeSet()
    {
        $name = $this->faker->words(2, true);
        $attributeSet = factory(AttributeSet::class)->create();
        $attributeSet->name = $name;
        $attributeSet->save();

        $this->assertDatabaseHas($attributeSet->getTable(), ['id' => $attributeSet->id, 'name' => $name]);
    }

    /**
     * Test that a catalog product attribute set can be deleted
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanDeleteAnAttributeSet()
    {
        $attributeSet = factory(AttributeSet::class)->create();
        $attributeSetData = $attributeSet->toArray();
        $attributeSetTable = $attributeSet->getTable();

        $this->assertDatabaseHas($attributeSetTable, $attributeSetData);

        $attributeSet->delete();

        $this->assertDatabaseMissing($attributeSetTable, $attributeSetData);
    }

    /**
     * Test that a catalog product attribute set can get its related products
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanGetProductsFromAnAttributeSet()
    {
        $attributeSet = factory(AttributeSet::class)->create();
        $productCount = rand(20, 40);

        for ($i = 0; $i < $productCount; $i++) {
            factory(Product::class)->create(['attribute_set_id' => $attributeSet->id]);
        }

        $products = $attributeSet->products;

        $this->assertEquals($productCount, count($products));
        $this->assertInstanceOf(Collection::class, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }

    /**
     * Test that a catalog product attribute set can get its related attributes
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanGetAttributesFromAnAttributeSet()
    {
        $attributeSet = factory(AttributeSet::class)->create();
        $attributeCount = rand(20, 40);

        for ($i = 0; $i < $attributeCount; $i++) {
            $attribute = factory(Attribute::class)->create();
            $attribute->attributeSets()->attach($attributeSet);
        }

        $attributes = $attributeSet->attributes;

        $this->assertEquals($attributeCount, count($attributes));
        $this->assertInstanceOf(Collection::class, $attributes);

        foreach ($attributes as $attribute) {
            $this->assertInstanceOf(Attribute::class, $attribute);
        }
    }
}
