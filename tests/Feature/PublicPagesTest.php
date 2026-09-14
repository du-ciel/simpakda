<?php

test('public welcome page can be accessed', function () {
    $response = $this->get(route('home'));
    $response->assertOk();
    $response->assertSee('Simpakda');
});

test('public features page can be accessed without login', function () {
    $response = $this->get(route('fitur'));
    $response->assertOk();
    $response->assertSee('Fitur');
});
