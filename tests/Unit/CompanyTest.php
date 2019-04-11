<?php

namespace Tests\Unit;

use App\Catalog\Category;
use App\Company;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a company can get its related users
     *
     * @test
     * @return  void
     */
    public function itCanGetUsersFromACompany()
    {
        $company = factory(Company::class)->create();
        $userCount = rand(3, 10);

        for ($i = 0; $i < $userCount; $i++) {
            factory(User::class)->create(['company_id' => $company->id]);
        }

        $users = $company->users;

        $this->assertEquals($userCount, count($users));
        $this->assertInstanceOf(Collection::class, $users);

        foreach ($users as $user) {
            $this->assertInstanceOf(User::class, $user);
        }
    }

    /**
     * Test that the accessor, and mutator for a company UUID do not change the UUID
     *
     * @test
     * @return void
     */
    public function accessorAndMutatorCannotChangeUuid()
    {
        $company = factory(Company::class)->make();
        $uuidOriginal = $company->uuid;
        $uuidAccessor = $company->getUuidAttribute(null);

        $company->setUuidAttribute('test');
        $uuidMutator = $company->uuid;

        $this->assertEquals($uuidOriginal, $uuidAccessor);
        $this->assertEquals($uuidOriginal, $uuidMutator);
        $this->assertEquals($uuidAccessor, $uuidMutator);
    }

    /**
     * Test that a company can get its related categories
     *
     * @return  void
     */
    public function testItCanGetCategoriesFromACompany()
    {
        $company = factory(Company::class)->create();
        $categoryCount = rand(3, 12);

        for ($i = 0; $i < $categoryCount; $i++) {
            factory(Category::class)->create(['company_id' => $company->id]);
        }

        $categories = $company->categories;

        $this->assertEquals($categoryCount, count($categories));
        $this->assertInstanceOf(Collection::class, $categories);
    }
}
