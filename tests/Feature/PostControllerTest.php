<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_feed_returns_posts_except_authenticated_user(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Post::factory()->create(['author_id' => $user->id]);
        $otherUserPost = Post::factory()->create(['author_id' => $otherUser->id]);

        $response = $this->actingAs($user)->getJson('/posts');

        $response->assertStatus(200)
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'id' => $otherUserPost->id,
                'title' => $otherUserPost->title,
                'body' => $otherUserPost->body,
                'author_id' => $otherUserPost->author_id,
            ]);
    }

    public function test_index_returns_cached_posts(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);

        Cache::shouldReceive('remember')
            ->once()
            ->andReturn(collect([$post]));

        $response = $this->actingAs($user)->getJson("/posts/user/{$user->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $post->id]);
    }

    public function test_store_creates_a_new_post(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/posts/create', [
            'title' => 'New Post',
            'body' => 'This is a new post body.',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Post created successfully.']);

        $this->assertDatabaseHas('posts', [
            'title' => 'New Post',
            'body' => 'This is a new post body.',
            'author_id' => $user->id,
        ]);
    }

    public function test_show_returns_a_single_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);

        $response = $this->actingAs($user)->getJson("/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $post->id]);
    }

    public function test_update_modifies_an_existing_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);

        $response = $this->actingAs($user)->putJson('/posts/update', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'body' => 'Updated body content.',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Post updated successfully.']);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'body' => 'Updated body content.',
        ]);
    }

    public function test_destroy_deletes_a_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['author_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Post deleted successfully.']);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}
