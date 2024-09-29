<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;

class DashboardControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_returns_dashboard_data_for_authenticated_user(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $post1 = Post::factory()->create([
            'author_id' => $user->id,
            'created_at' => now()->subDays(2),
        ]);

        $post2 = Post::factory()->create(['author_id' => $user->id]);

        Like::factory()->count(3)->create(['post_id' => $post1->id]);
        Like::factory()->count(2)->create(['post_id' => $post2->id]);
        Comment::factory()->count(1)->create(['post_id' => $post1->id]);

        $response = $this->getJson('/dashboard');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'total_posts',
            'total_likes',
            'total_comments',
            'post_with_most_likes' => [
                'title',
                'authorId',
                'id',
                'body',
                'comment',
                'likes' => [
                    '*' => [
                        'id',
                        'user_id',
                        'post_id',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'comments' => [
                    '*' => [
                        'id',
                        'user_id',
                        'post_id',
                        'comment',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ],
            'most_recent_post' => [
                'title',
                'authorId',
                'id',
                'body',
                'comment',
                'likes',
                'comments',
            ],
        ]);


        $data = $response->json();

        $this->assertEquals(2, $data['total_posts']);
        $this->assertEquals(5, $data['total_likes']);
        $this->assertEquals(1, $data['total_comments']);

        $mostRecentPost = $data['most_recent_post'];
        $this->assertNotNull($mostRecentPost);
        $this->assertEquals($post2->id, $mostRecentPost['id']);

        $postWithMostLikes = $data['post_with_most_likes'];
        $this->assertNotNull($postWithMostLikes);
        $this->assertEquals($post1->id, $postWithMostLikes['id']);
        $this->assertCount(3, $postWithMostLikes['likes']);
    }
}
