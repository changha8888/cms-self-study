<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Posts;

class PostsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_posts()
    {
        $posts = factory(Posts::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/posts', $posts
        );

        $this->assertApiResponse($posts);
    }

    /**
     * @test
     */
    public function test_read_posts()
    {
        $posts = factory(Posts::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/posts/'.$posts->id
        );

        $this->assertApiResponse($posts->toArray());
    }

    /**
     * @test
     */
    public function test_update_posts()
    {
        $posts = factory(Posts::class)->create();
        $editedPosts = factory(Posts::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/posts/'.$posts->id,
            $editedPosts
        );

        $this->assertApiResponse($editedPosts);
    }

    /**
     * @test
     */
    public function test_delete_posts()
    {
        $posts = factory(Posts::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/posts/'.$posts->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/posts/'.$posts->id
        );

        $this->response->assertStatus(404);
    }
}
