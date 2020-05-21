<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** @test */
    public function can_view_home_page()
    {
        $this->get(route('home'))->assertSuccessful();
    }
}
