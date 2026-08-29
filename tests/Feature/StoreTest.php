<?php

use App\Models\Store;

it('can create a store', function () {
    $response = $this->post('/stores', [
        'name' => 'Café Nusa',
        'address' => 'Jl. Merdeka 12',
        'city' => 'Bandung',
        'phone' => '08123456789',
        'email' => 'hello@cafenusa.test',
        'description' => 'A cozy neighborhood café.',
        'is_active' => true,
    ]);

    $response->assertRedirect('/stores');
    $this->assertDatabaseHas('stores', ['name' => 'Café Nusa', 'city' => 'Bandung']);
});

it('can list stores', function () {
    Store::factory()->create(['name' => 'Resto Prime']);

    $response = $this->get('/stores');

    $response->assertOk();
    $response->assertSee('Resto Prime');
});
