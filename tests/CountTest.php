<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CountTest extends TestCase
{
    /**
     * Testing country count
     *
     * @return void
     */
    public function testCounter()
    {
        $this->post('/counter', ["country_code" => "us"]);
        $this->assertEquals(
            201, $this->response->getStatusCode()
        );
        app('redis')->hDel("countries", "us");
    }

    /**
     * Testing country count negative
     *
     * @return void
     */
    public function testCounterNegative()
    {
        $this->post('/counter', ["country_code" => 11]);
        $this->assertEquals(
            422, $this->response->getStatusCode()
        );
        $this->post('/counter', ["country_code" => 112]);
        $this->assertEquals(
            422, $this->response->getStatusCode()
        );
        $this->post('/counter', ["country_code" => "JAP"]);
        $this->assertEquals(
            422, $this->response->getStatusCode()
        );
        $this->post('/counter', ["country_code" => "11"]);
        $this->assertEquals(
            422, $this->response->getStatusCode()
        );
    }

    /**
     * Test to get country count
     *
     * @return void
     */
    public function testGet()
    {
        $this->post('/counter', ["country_code" => "us"]);
        $this->get('/counter')->seeJsonContains([['code' => 'us', 'count' => 1]]);
        $this->assertEquals(
            200, $this->response->getStatusCode()
        );
        app('redis')->hDel("countries", "us");
    }
}
