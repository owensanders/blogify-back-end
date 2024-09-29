<?php

namespace Tests\Unit\Presenters;

use App\DataTransferObjects\PostDto;
use App\Presenters\DashboardPresenter;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use stdClass;

class DashboardPresenterTest extends TestCase
{
    private DashboardPresenter $presenter;

    protected function setUp(): void
    {
        parent::setUp();
        $this->presenter = new DashboardPresenter();
    }

    public function testPresentUserPostsReturnsExpectedDataStructure(): void
    {
        $post1 = new PostDto(
            title: "First Post",
            authorId: 1,
            id: 1,
            body: "This is the first post.",
            likes: new Collection([new stdClass()]),
            comments: new Collection([new stdClass(), new stdClass()])
        );

        $post2 = new PostDto(
            title: "Second Post",
            authorId: 2,
            id: 2,
            body: "This is the second post.",
            likes: new Collection([]),
            comments: new Collection([])
        );

        $post3 = new PostDto(
            title: "Third Post",
            authorId: 3,
            id: 3,
            body: "This is the third post.",
            likes: new Collection([new stdClass(), new stdClass()]),
            comments: new Collection([new stdClass()])
        );

        $posts = new Collection([$post1, $post2, $post3]);
        $mostRecentPost = new PostDto(title: "Most Recent Post", authorId: 4, id: 4, body: "This is the most recent post.");

        $result = $this->presenter->presentUserPosts($posts, $mostRecentPost);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('total_posts', $result);
        $this->assertArrayHasKey('total_likes', $result);
        $this->assertArrayHasKey('total_comments', $result);
        $this->assertArrayHasKey('post_with_most_likes', $result);
        $this->assertArrayHasKey('most_recent_post', $result);
        $this->assertEquals(3, $result['total_posts']);
        $this->assertEquals(3, $result['total_likes']);
        $this->assertEquals(3, $result['total_comments']);
        $this->assertEquals($post3, $result['post_with_most_likes']);
        $this->assertEquals($mostRecentPost, $result['most_recent_post']);
    }
}
