<?php

namespace Tests\Unit\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use App\Catalog\Product\AttributeTemplate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTemplateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a catalog product attribute template can be created
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanCreateAnAttributeTemplate()
    {
        $data = [
            'name' => $this->faker->words(2, true),
        ];

        $attributeTemplate = factory(AttributeTemplate::class)->create($data);

        $this->assertInstanceOf(AttributeTemplate::class, $attributeTemplate);
        $this->assertDatabaseHas($attributeTemplate->getTable(), $data);
    }

    /**
     * Test that a catalog product attribute template can be updated
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanUpdateAnAttributeTemplate()
    {
        $name = $this->faker->words(2, true);
        $attributeTemplate = factory(AttributeTemplate::class)->create();
        $attributeTemplate->name = $name;
        $attributeTemplate->save();

        $this->assertDatabaseHas($attributeTemplate->getTable(), ['id' => $attributeTemplate->id, 'name' => $name]);
    }

    /**
     * Test that a catalog product attribute template can be deleted
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanDeleteAnAttributeTemplate()
    {
        $attributeTemplate = factory(AttributeTemplate::class)->create();
        $attributeTemplateData = $attributeTemplate->toArray();
        $attributeTemplateTable = $attributeTemplate->getTable();

        $this->assertDatabaseHas($attributeTemplateTable, $attributeTemplateData);

        $attributeTemplate->delete();

        $this->assertDatabaseMissing($attributeTemplateTable, $attributeTemplateData);
    }

    /**
     * Test that a catalog product attribute template can get its related products
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanGetProductsFromAnAttributeTemplate()
    {
        $attributeTemplate = factory(AttributeTemplate::class)->create();
        $productCount = rand(20, 40);

        for ($i = 0; $i < $productCount; $i++) {
            factory(Product::class)->create(['attribute_template_id' => $attributeTemplate->id]);
        }

        $products = $attributeTemplate->products;

        $this->assertEquals($productCount, count($products));
        $this->assertInstanceOf(Collection::class, $products);

        foreach ($products as $product) {
            $this->assertInstanceOf(Product::class, $product);
        }
    }

    /**
     * Test that a catalog product attribute template can get its related attributes
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanGetAttributesFromAnAttributeTemplate()
    {
        $attributeTemplate = factory(AttributeTemplate::class)->create();
        $attributeCount = rand(20, 40);

        for ($i = 0; $i < $attributeCount; $i++) {
            $attribute = factory(Attribute::class)->create();
            $attribute->attributeTemplates()->attach($attributeTemplate);
        }

        $attributes = $attributeTemplate->attributes;

        $this->assertEquals($attributeCount, count($attributes));
        $this->assertInstanceOf(Collection::class, $attributes);

        foreach ($attributes as $attribute) {
            $this->assertInstanceOf(Attribute::class, $attribute);
        }
    }
}
