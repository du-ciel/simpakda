<?php

use App\Models\User;
use App\Models\Vehicle;

test('vehicle export streams a CSV download and escapes spreadsheet formulas', function () {
    $user = User::factory()->create();
    Vehicle::factory()->create([
        'merek' => '=SUM(1,1)',
    ]);

    $response = $this->actingAs($user)->get(route('vehicles.export', ['format' => 'csv']));

    $response->assertOk()
        ->assertHeader('content-type', 'text/csv; charset=UTF-8')
        ->assertHeader('content-disposition');

    expect($response->streamedContent())->toContain("'=SUM(1,1)");
});
