<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_regular_user_cannot_access_admin(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertForbidden();
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertOk();
        $response->assertSee('Admin Dashboard');
    }

    public function test_admin_dashboard_shows_pagination(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        User::factory()->count(15)->create();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertOk();
    }

    public function test_admin_can_delete_listing(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $listing = Listing::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.listings.delete', $listing));
        $response->assertRedirect();
        $this->assertDatabaseMissing('listings', ['id' => $listing->id]);
    }

    public function test_admin_can_delete_product(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.products.delete', $product));
        $response->assertRedirect();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_admin_can_delete_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.services.delete', $service));
        $response->assertRedirect();
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
