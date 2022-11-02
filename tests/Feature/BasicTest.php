<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

# Import Box class
use App\Box;

class BasicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function testBoxContents()
    {
        $box = new Box(['toy']);
        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }

    public function testTakeOnefromTheBox()
    {
        $box = new Box(['touch']);
        $this->assertEquals('touch', $box->takeOne());

        //Null now box is empty
        $this->assertNull($box->takeOne());
    }

    public function testStartWithALetter()
    {
        $box = new Box(['toy', 'torch', 'ball', 'cat', 'tissue']);

        $results = $box->startsWith('t');

        $this->assertCount(3, $results);
        $this->assertContains('toy', $results);
        $this->assertContains('torch', $results);
        $this->assertContains('tissue', $results);

        // Empty array if passed even
        $this->assertEmpty($box->startsWith('s'));
    }


}
