<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {

        $data = json_encode(['cdk'=>'FE8924B077','__access_time__'=>time()]);
        echo \Rsa::pubEncrypt($data);
        $this->assertTrue(true);
    }
}
