<?php

namespace Tests\Unit\Catalog;

use App\Catalog\Category;
use App\Catalog\Product;
use App\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a catalog category can be created
     *
     * @return  void
     */
    public function testItCanCreateACategory()
    {
        $data = [
            'name' => $this->faker->words(2, true),
        ];

        $category = factory(Category::class)->create($data);

        $this->assertInstanceOf(Category::class, $category);
        $this->assertDatabaseHas($category->getTable(), $data);
    }

    /**
     * Test that a catalog category can be updated
     *
     * @return  void
     */
    public function testItCanUpdateACategory()
    {
        $name = $this->faker->words(2, true);
        $category = factory(Category::class)->create();
        $category->name = $name;
        $category->save();

        $this->assertDatabaseHas($category->getTable(), ['id' => $category->id, 'name' => $name]);
    }

    /**
     * Test that a catalog category can be deleted
     *
     * @return  void
     */
    public function testItCanDeleteACategory()
    {
        $category = factory(Category::class)->create();
        $categoryData = $category->toArray();
        $categoryTable = $category->getTable();

        $this->assertDatabaseHas($categoryTable, $categoryData);

        $category->delete();

        $this->assertDatabaseMissing($categoryTable, $categoryData);
    }

    /**
     * Test that a catalog category can get its related company
     *
     * @return  void
     */
    public function testItCanGetACompanyFromACategory()
    {
        $category = factory(Category::class)->create();
        $company = $category->company;

        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals($category->company_id, $company->id);
    }

    /**
     * Test that a catalog category can get its related products
     *
     * @return  void
     */
    public function testItCanGetProductsFromACategory()
    {
        $category = factory(Category::class)->create();

        $productCount = rand(3, 12);

        for ($i = 0; $i < $productCount; $i++) {
            factory(Product::class)->create()->categories()->attach($category);
        }

        $products = $category->products;

        $this->assertInstanceOf(Collection::class, $products);
        $this->assertEquals($productCount, $products->count());
    }
}
