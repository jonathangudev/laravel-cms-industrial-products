<?php

namespace Tests\Unit\Catalog\Product;

use App\Catalog\Product\Attribute;
use App\Catalog\Product\AttributeValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a catalog product attribute can be created
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanCreateAnAttribute()
    {
        $data = [
            'name' => $this->faker->words(2, true),
        ];

        $attribute = factory(Attribute::class)->create($data);

        $this->assertInstanceOf(Attribute::class, $attribute);
        $this->assertDatabaseHas($attribute->getTable(), $data);
    }

    /**
     * Test that a catalog product attribute can be updated
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanUpdateAnAttribute()
    {
        $name = $this->faker->words(2, true);
        $attribute = factory(Attribute::class)->create();
        $attribute->name = $name;
        $attribute->save();

        $this->assertDatabaseHas($attribute->getTable(), ['id' => $attribute->id, 'name' => $name]);
    }

    /**
     * Test that a catalog product attribute can be deleted
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanDeleteAnAttribute()
    {
        $attribute = factory(Attribute::class)->create();
        $attributeData = $attribute->toArray();
        $attributeTable = $attribute->getTable();

        $this->assertDatabaseHas($attributeTable, $attributeData);

        $attribute->delete();

        $this->assertDatabaseMissing($attributeTable, $attributeData);
    }

    /**
     * Test that a catalog product attribute can get its related value
     *
     * @return  void
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function testItCanGetAnAttributeValueFromAnAttribute()
    {
        $attributeValue = factory(AttributeValue::class)->create();
        $attribute = Attribute::find($attributeValue->attribute_id);

        $this->assertInstanceOf(AttributeValue::class, $attribute->value);

        // Update automatically set values
        $attributeValue->is_hidden = $attribute->value->is_hidden;
        $attributeValue->company_id = $attribute->value->company_id;

        $this->assertEquals($attributeValue->toArray(), $attribute->value->toArray());
    }
}
