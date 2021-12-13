<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersListTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_list_loaded()
    {
        $user = User::factory()->create();

        $response = $this->get('/users');

        $response->assertStatus(200);

        foreach (['ID', 'Name', 'Email', 'Created at'] as $column) {
            $response->assertSee('<span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">'.$column.'</span>', false);
        }

        foreach (['id', 'name', 'email', 'created_at'] as $column) {
            $response->assertSee('<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                        ' . $user->$column . '
                                    </td>', false);
        }
    }
}
