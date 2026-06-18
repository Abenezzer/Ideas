<?php

use App\Models\User;
use App\Models\Idea;
use App\Models\Step;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user can have many ideas and an idea belongs to a user', function () {
    // Arrange: Create a user and 3 ideas assigned to them
    $user = User::factory()->create();
    $ideas = Idea::factory()->count(3)->create(['user_id' => $user->id]);

    // Act & Assert: Test HasMany side
    expect($user->ideas)
        ->toHaveCount(3)
        ->contains($ideas->first())->toBeTrue();

    // Act & Assert: Test BelongsTo side
    expect($ideas->first()->user)
        ->toBeInstanceOf(User::class)
        ->id->toBe($user->id);
});

test('an idea can have many steps and a step belongs to an idea', function () {
    // Arrange: Create an idea and 4 steps assigned to it
    $idea = Idea::factory()->create();
    $steps = Step::factory()->count(4)->create(['idea_id' => $idea->id]);

    // Act & Assert: Test HasMany side
    expect($idea->steps)
        ->toHaveCount(4)
        ->contains($steps->first())->toBeTrue();

    // Act & Assert: Test BelongsTo side
    expect($steps->first()->idea)
        ->toBeInstanceOf(Idea::class)
        ->id->toBe($idea->id);
});

test('a user ideas relationship returns an empty collection when no ideas exist', function () {
    $user = User::factory()->create();

    expect($user->ideas)
        ->toHaveCount(0)
        ->isEmpty()->toBeTrue();
});

test('an idea steps relationship returns an empty collection when no steps exist', function () {
    $idea = Idea::factory()->create();

    expect($idea->steps)
        ->toHaveCount(0)
        ->isEmpty()->toBeTrue();
});