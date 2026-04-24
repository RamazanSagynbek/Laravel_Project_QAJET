<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_listings_page_is_displayed(): void
    {
        Listing::factory()->count(3)->create();

        $response = $this->get(route('listings.index'));
        $response->assertOk();
        $response->assertSee('Listing');
    }

    public function test_guest_cannot_create_listing(): void
    {
        $response = $this->get(route('listings.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_can_create_listing(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('listings.store'), [
            'title' => 'Test Room',
            'description' => 'Nice room near uni',
            'price' => 100000,
            'address' => 'Abay 50',
            'city' => 'Almaty',
            'rooms' => 2,
            'roommates_needed' => 1,
            'type' => 'offering_room',
        ]);

        $response->assertRedirect(route('listings.index'));
        $this->assertDatabaseHas('listings', ['title' => 'Test Room']);
    }

    public function test_user_can_update_own_listing(): void
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('listings.update', $listing), [
            'title' => 'Updated Title',
            'description' => $listing->description,
            'price' => $listing->price,
            'address' => $listing->address,
            'city' => $listing->city,
            'rooms' => $listing->rooms,
            'roommates_needed' => $listing->roommates_needed,
            'type' => $listing->type,
        ]);

        $response->assertRedirect(route('listings.show', $listing));
        $this->assertDatabaseHas('listings', ['id' => $listing->id, 'title' => 'Updated Title']);
    }

    public function test_user_cannot_update_others_listing(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $listing = Listing::factory()->create(['user_id' => $other->id]);

        $response = $this->actingAs($user)->get(route('listings.edit', $listing));
        $response->assertForbidden();
    }

    public function test_admin_can_delete_any_listing(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $listing = Listing::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.listings.delete', $listing));
        $response->assertRedirect();
        $this->assertDatabaseMissing('listings', ['id' => $listing->id]);
    }

    public function test_listing_filter_by_city_works(): void
    {
        Listing::factory()->create(['city' => 'Almaty', 'status' => 'active']);
        Listing::factory()->create(['city' => 'Astana', 'status' => 'active']);

        $response = $this->get(route('listings.index', ['city' => 'Almaty']));
        $response->assertOk();
        $response->assertSee('Almaty');
    }
}
