<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_page_is_displayed(): void
    {
        Service::factory()->count(3)->create();

        $response = $this->get(route('services.index'));
        $response->assertOk();
    }

    public function test_guest_cannot_create_service(): void
    {
        $response = $this->get(route('services.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_can_create_service(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->service()->create();

        $response = $this->actingAs($user)->post(route('services.store'), [
            'title' => 'Tutoring',
            'description' => 'Math tutoring',
            'price' => 15000,
            'price_type' => 'hourly',
            'category_id' => $category->id,
        ]);

        $response->assertRedirect(route('services.index'));
        $this->assertDatabaseHas('services', ['title' => 'Tutoring']);
    }

    public function test_user_can_update_own_service(): void
    {
        $user = User::factory()->create();
        $service = Service::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('services.update', $service), [
            'title' => 'Updated Tutoring',
            'description' => $service->description,
            'price' => $service->price,
            'price_type' => $service->price_type,
            'category_id' => $service->category_id,
        ]);

        $response->assertRedirect(route('services.show', $service));
        $this->assertDatabaseHas('services', ['id' => $service->id, 'title' => 'Updated Tutoring']);
    }

    public function test_user_cannot_update_others_service(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $service = Service::factory()->create(['user_id' => $other->id]);

        $response = $this->actingAs($user)->get(route('services.edit', $service));
        $response->assertForbidden();
    }

    public function test_admin_can_delete_any_service(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $service = Service::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.services.delete', $service));
        $response->assertRedirect();
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }
}
