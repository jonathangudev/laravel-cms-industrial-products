<?php

namespace Tests\Unit\Company;

use App\Company;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test that a user can get its related company
     *
     * @test
     * @return  void
     */
    public function itCanGetACompanyFromAUser()
    {
        $user = factory(User::class)->create();
        $company = $user->company;

        $this->assertInstanceOf(Company::class, $company);
        $this->assertEquals($user->company_id, $company->id);
    }
}
