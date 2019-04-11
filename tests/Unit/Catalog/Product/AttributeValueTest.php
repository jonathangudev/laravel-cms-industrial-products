<?php

namespace Tests\Unit\Catalog\Product;

use App\Catalog\Product;
use App\Catalog\Product\Attribute;
use App\Catalog\Product\AttributeValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeValueTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * Test that a catalog attribute value can be created
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanCreateAnAttributeValue()
    {
        $data = [
            'value' => $this->faker->text,
        ];

        $attributeValue = factory(AttributeValue::class)->create($data);

        $this->assertInstanceOf(AttributeValue::class, $attributeValue);
        $this->assertDatabaseHas($attributeValue->getTable(), $data);
    }

    /**
     * Test that a catalog product attribute value can be updated
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanUpdateAnAttributeValue()
    {
        $value = $this->faker->text;
        $attributeValue = factory(AttributeValue::class)->create();
        $attributeValue->value = $value;
        $attributeValue->save();

        $this->assertDatabaseHas($attributeValue->getTable(), ['id' => $attributeValue->id, 'value' => $value]);
    }

    /**
     * Test that a catalog product attribute can be deleted
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanDeleteAnAttributeValue()
    {
        $attributeValue = factory(AttributeValue::class)->create();
        $attributeValueData = $attributeValue->toArray();
        $attributeValueTable = $attributeValue->getTable();

        $this->assertDatabaseHas($attributeValueTable, $attributeValueData);

        $attributeValue->delete();

        $this->assertDatabaseMissing($attributeValueTable, $attributeValueData);
    }

    /**
     * Test that a catalog product attribute value can get its owning attribute
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanGetAnAttributeFromAnAttributeValue()
    {
        $attributeValue = factory(AttributeValue::class)->create();
        $attribute = $attributeValue->attribute;

        $this->assertInstanceOf(Attribute::class, $attribute);
        $this->assertEquals($attributeValue->attribute_id, $attribute->id);
    }

    /**
     * Test that a catalog product attribute value gets its name from the owning attribute
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanGetAnAttributeNameFromAnAttributeValue()
    {
        $attributeValue = factory(AttributeValue::class)->create();
        $attribute = $attributeValue->attribute;

        $this->assertEquals($attributeValue->getAttributeNameAttribute(), $attribute->name);
    }

    /**
     * Test that a catalog product attribute value gets its description from the owning attribute
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanGetAnAttributeDescriptionFromAnAttributeValue()
    {
        $attributeValue = factory(AttributeValue::class)->create();
        $attribute = $attributeValue->attribute;

        $this->assertEquals($attributeValue->description, $attribute->description);
    }

    /**
     * Test that a catalog product attribute value can get its owning product
     *
     * @test
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function itCanGetAProductFromAnAttributeValue()
    {
        $attributeValue = factory(AttributeValue::class)->create();
        $product = $attributeValue->product;

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals($attributeValue->product_id, $product->id);
    }
}
