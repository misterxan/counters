<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCounter()
    {
        $this->post('/counter/es');
        $this->assertEquals(
            201, $this->response->getStatusCode()
        );
        app('redis')->hDel("countries", "es");
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGet()
    {
        $this->post('/counter/es');
        $this->get('/counter')->seeJsonContains([['code' => 'es', 'count' => 1]]);
        $this->assertEquals(
            200, $this->response->getStatusCode()
        );
        app('redis')->hDel("countries", "es");
    }
}
