<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('new users can not register themselves as admin', function () {
    $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'user_type' => 'admin',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    expect(auth()->user()->user_type)->toBe('user');
});
