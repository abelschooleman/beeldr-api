<?php

use App\Models\User;

class AuthTest extends TestCase
{
    /**
     * Test the api response.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');
        $this->assertEquals('Hello', $this->response->getContent());
    }

    /**
     * Given an invalid username, a user can't login
     *
     * @return void
     */
    public function testFalseUsername()
    {
        $this->post('/api/auth/login', [
            'email' => 'invalid@nodomain.tt',
            'password' => 'SomePassword!9'
        ]);

        $this->assertResponseStatus(401);
    }

    /**
     * Given an invalid password, a user can't login
     *
     * @return void
     */
    public function testFalsePassword()
    {
        $user = User::inRandomOrder()->first();

        $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'SomeInvalidPassword!9'
        ]);

        $this->assertResponseStatus(401);
    }

    /**
     * Given valid credentials, a user can login
     *
     * @return void
     */
    public function testValidLogin()
    {
        $user = User::inRandomOrder()->first();

        $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => 'SomePassword!9'
        ]);

        $response = json_decode($this->response->getContent());

        $this->assertObjectHasAttribute('token', $response);
    }
}
