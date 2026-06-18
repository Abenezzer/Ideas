<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{assertAuthenticatedAs, assertGuest, post};

// Un-comment this line if you didn't set RefreshDatabase globally in tests/Pest.php
// uses(RefreshDatabase::class);

test('a user can log in with correct credentials', function () {
    // Arrange: Create a user in the database
    $user = User::factory()->create([
        'email' => 'alex@example.com',
        'password' => bcrypt('secret-password'), // Encrypt the password
    ]);

    // Act: Submit the login form
    $response = post('/login', [
        'email' => 'alex@example.com',
        'password' => 'secret-password',
    ]);

    // Assert: Check redirect to '/'
    $response->assertRedirect('/');

    // Assert: Verify the specific user is authenticated
    assertAuthenticatedAs($user);
});

test('a user cannot log in with an incorrect password', function () {
    // Arrange: Create a user
    User::factory()->create([
        'email' => 'alex@example.com',
        'password' => bcrypt('secret-password'),
    ]);

    // Act: Attempt login with the wrong password
    $response = post('/login', [
        'email' => 'alex@example.com',
        'password' => 'wrong-password', // Invalid
    ]);

    // Assert: Verify they are redirected back with errors
    $response->assertSessionHasErrors(['password']);
    
    // Assert: Make sure they are still a guest
    assertGuest();
});

test('a user cannot log in with a non-existent email', function () {
    // Act: Attempt login with an email not in the database
    $response = post('/login', [
        'email' => 'nobody@example.com',
        'password' => 'password123',
    ]);

    // Assert
    $response->assertSessionHasErrors(['password']);
    assertGuest();
});