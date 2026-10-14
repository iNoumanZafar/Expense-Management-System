<?php

use App\Models\User;

test('admin is sent to the admin dashboard', function () {
    $admin = User::factory()->create(['user_type' => 'admin']);

    $this->actingAs($admin)->get('/dashboard')->assertRedirect('/admin/dashboard');
    $this->actingAs($admin)->get('/admin/dashboard')->assertOk();
});

test('user is sent to the user dashboard', function () {
    $user = User::factory()->create(['user_type' => 'user']);

    $this->actingAs($user)->get('/dashboard')->assertRedirect('/user/dashboard');
    $this->actingAs($user)->get('/user/dashboard')->assertOk();
});

test('user can not open the admin dashboard', function () {
    $user = User::factory()->create(['user_type' => 'user']);

    $this->actingAs($user)->get('/admin/dashboard')->assertForbidden();
});

test('admin can not open the user dashboard', function () {
    $admin = User::factory()->create(['user_type' => 'admin']);

    $this->actingAs($admin)->get('/user/dashboard')->assertForbidden();
});

test('guest is sent to the login page', function () {
    $this->get('/admin/dashboard')->assertRedirect('/login');
    $this->get('/user/dashboard')->assertRedirect('/login');
});
