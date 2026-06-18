<?php

use App\Models\User;
use function Pest\Laravel\{assertDatabaseHas, assertAuthenticated, post, get};

test('a user can register successfully with valid data', function () {
    // Act: Send a POST request to the registration route
    $response = post('/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password123',
    ]);

    // Assert: Check redirect to '/'
    $response->assertRedirect('/');

    // Assert: Verify the user exists in the database
    assertDatabaseHas('users', [
        'email' => 'john@example.com',
        'name' => 'John Doe',
    ]);

    // Assert: Verify the user is automatically logged in
    assertAuthenticated();
});

test('registration fails if name is less than 3 characters', function () {
    $response = post('/register', [
        'name' => 'Jo', // Too short
        'email' => 'john@example.com',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors(['name']);
});

test('registration fails if name is more than 250 characters', function () {
    $response = post('/register', [
        'name' => str_repeat('a', 251), // Too long
        'email' => 'john@example.com',
        'password' => 'password123',
    ]);

    $response->assertSessionHasErrors(['name']);
});

test('registration fails if email is not unique', function () {
    // Arrange: Create an existing user
    User::factory()->create([
        'email' => 'existing@example.com',
    ]);

    // Act: Try to register with the same email
    $response = post('/register', [
        'name' => 'Jane Doe',
        'email' => 'existing@example.com',
        'password' => 'password123',
    ]);

    // Assert
    $response->assertSessionHasErrors(['email']);
});

test('registration fails if password is less than 6 characters', function () {
    $response = post('/register', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => '12345', // Too short
    ]);

    $response->assertSessionHasErrors(['password']);
});