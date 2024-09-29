<?php

namespace Tests\Unit\UseCases;

use App\DataTransferObjects\PostDto;
use App\Interfaces\PostRepositoryInterface;
use App\UseCases\GetDashboardDataUseCase;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class GetDashboardDataUseCaseTest extends TestCase
{
    private PostRepositoryInterface $postRepository;
    private GetDashboardDataUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepository = $this->createMock(PostRepositoryInterface::class);
        $this->useCase = new GetDashboardDataUseCase($this->postRepository);
    }

    public function testHandleReturnsExpectedDataStructure(): void
    {
        $posts = new Collection([
            new PostDto(title: "First Post", authorId: 1, id: 1, body: "This is the first post."),
            new PostDto(title: "Second Post", authorId: 2, id: 2, body: "This is the second post."),
        ]);

        $mostRecentPost = new PostDto(title: "Most Recent Post", authorId: 3, id: 3, body: "This is the most recent post.");

        $this->postRepository->expects($this->once())
            ->method('getUserPosts')
            ->willReturn($posts);

        $this->postRepository->expects($this->once())
            ->method('getUsersMostRecentPost')
            ->willReturn($mostRecentPost);

        $result = $this->useCase->handle();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('posts', $result);
        $this->assertArrayHasKey('mostRecentPost', $result);
        $this->assertInstanceOf(Collection::class, $result['posts']);
        $this->assertInstanceOf(PostDto::class, $result['mostRecentPost']);
        $this->assertEquals("Most Recent Post", $result['mostRecentPost']->title);
        $this->assertEquals(3, $result['mostRecentPost']->authorId);
        $this->assertEquals(3, $result['mostRecentPost']->id);
    }
}
