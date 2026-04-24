<?php

namespace Tests\Feature;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_community(): void
    {
        $response = $this->get(route('chats.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_without_university_is_redirected_to_profile(): void
    {
        $user = User::factory()->create(['university' => null]);

        $response = $this->actingAs($user)->get(route('chats.index'));
        $response->assertRedirect(route('profile.edit'));
    }

    public function test_user_with_university_can_see_chats(): void
    {
        $user = User::factory()->create(['university' => 'KBTU']);
        Chat::factory()->group()->create(['university' => 'KBTU']);

        $response = $this->actingAs($user)->get(route('chats.index'));
        $response->assertOk();
    }

    public function test_user_can_create_private_chat(): void
    {
        $user = User::factory()->create(['university' => 'KBTU']);
        $other = User::factory()->create(['university' => 'KBTU']);

        $response = $this->actingAs($user)->post(route('chats.store'), [
            'user_id' => $other->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('chats', ['type' => 'private']);
    }

    public function test_user_cannot_access_private_chat_they_are_not_in(): void
    {
        $user = User::factory()->create(['university' => 'KBTU']);
        $other = User::factory()->create(['university' => 'KBTU']);
        $chat = Chat::factory()->private()->create();
        $chat->users()->attach($other->id);

        $response = $this->actingAs($user)->get(route('chats.show', $chat));
        $response->assertForbidden();
    }

    public function test_user_can_send_message_in_chat(): void
    {
        $user = User::factory()->create(['university' => 'KBTU']);
        $chat = Chat::factory()->group()->create(['university' => 'KBTU']);
        $chat->users()->attach($user->id);

        $response = $this->actingAs($user)->post(route('messages.store', $chat), [
            'body' => 'Hello everyone!',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('messages', ['body' => 'Hello everyone!', 'user_id' => $user->id]);
    }

    public function test_user_can_auto_join_group_chat(): void
    {
        $user = User::factory()->create(['university' => 'KBTU']);
        $chat = Chat::factory()->group()->create(['university' => 'KBTU']);

        $response = $this->actingAs($user)->get(route('chats.show', $chat));
        $response->assertOk();
        $this->assertDatabaseHas('chat_user', ['chat_id' => $chat->id, 'user_id' => $user->id]);
    }
}
