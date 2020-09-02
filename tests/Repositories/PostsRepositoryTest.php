<?php namespace Tests\Repositories;

use App\Models\Posts;
use App\Repositories\PostsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PostsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PostsRepository
     */
    protected $postsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->postsRepo = \App::make(PostsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_posts()
    {
        $posts = factory(Posts::class)->make()->toArray();

        $createdPosts = $this->postsRepo->create($posts);

        $createdPosts = $createdPosts->toArray();
        $this->assertArrayHasKey('id', $createdPosts);
        $this->assertNotNull($createdPosts['id'], 'Created Posts must have id specified');
        $this->assertNotNull(Posts::find($createdPosts['id']), 'Posts with given id must be in DB');
        $this->assertModelData($posts, $createdPosts);
    }

    /**
     * @test read
     */
    public function test_read_posts()
    {
        $posts = factory(Posts::class)->create();

        $dbPosts = $this->postsRepo->find($posts->id);

        $dbPosts = $dbPosts->toArray();
        $this->assertModelData($posts->toArray(), $dbPosts);
    }

    /**
     * @test update
     */
    public function test_update_posts()
    {
        $posts = factory(Posts::class)->create();
        $fakePosts = factory(Posts::class)->make()->toArray();

        $updatedPosts = $this->postsRepo->update($fakePosts, $posts->id);

        $this->assertModelData($fakePosts, $updatedPosts->toArray());
        $dbPosts = $this->postsRepo->find($posts->id);
        $this->assertModelData($fakePosts, $dbPosts->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_posts()
    {
        $posts = factory(Posts::class)->create();

        $resp = $this->postsRepo->delete($posts->id);

        $this->assertTrue($resp);
        $this->assertNull(Posts::find($posts->id), 'Posts should not exist in DB');
    }
}
