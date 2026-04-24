<?php

namespace Tests\Unit;

use App\Models\Listing;
use App\Models\User;
use App\Policies\ListingPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_update(): void
    {
        $policy = new ListingPolicy();
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($policy->update($user, $listing));
    }

    public function test_non_owner_cannot_update(): void
    {
        $policy = new ListingPolicy();
        $user = User::factory()->create();
        $other = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $other->id]);

        $this->assertFalse($policy->update($user, $listing));
    }

    public function test_admin_can_update_any(): void
    {
        $policy = new ListingPolicy();
        $admin = User::factory()->create(['role' => 'admin']);
        $other = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $other->id]);

        $this->assertTrue($policy->update($admin, $listing));
    }
}
