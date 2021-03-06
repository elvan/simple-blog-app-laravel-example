<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');

        $response->assertSeeText('Home Page');
        $response->assertSeeText('This is the content of the Home Page');
    }

    public function testContactPage()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact');
        $response->assertSeeText('Please feel free to contact us, our customer service center is working for you 24/7.');
    }
}
