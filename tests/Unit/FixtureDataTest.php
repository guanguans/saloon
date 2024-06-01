<?php

declare(strict_types=1);

namespace Saloon\Tests\Unit;

use Saloon\Data\RecordedResponse;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use Saloon\Tests\Fixtures\Requests\DTORequest;

test('you can create a fixture data object from a file string', function () {
    $data = [
        'statusCode' => 200,
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'data' => [
            'name' => 'Sam',
        ],
    ];

    $fixtureData = RecordedResponse::fromFile(json_encode($data));

    expect($fixtureData->statusCode)->toEqual($data['statusCode']);
    expect($fixtureData->headers)->toEqual($data['headers']);
    expect($fixtureData->data)->toEqual($data['data']);
});

test('you can create a mock response from fixture data', function () {
    $data = [
        'statusCode' => 200,
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'data' => [
            'name' => 'Sam',
        ],
    ];

    $fixtureData = RecordedResponse::fromFile(json_encode($data));
    $mockResponse = $fixtureData->toMockResponse();

    expect($mockResponse)->toEqual(new MockResponse($data['data'], $data['statusCode'], $data['headers']));
});

test('you can json serialize the fixture data or convert it into a file', function () {
    $data = [
        'statusCode' => 200,
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'data' => [
            'name' => 'Sam',
        ],
    ];

    $fixtureData = RecordedResponse::fromFile(json_encode($data, JSON_PRETTY_PRINT));

    $serialized = json_encode($fixtureData, JSON_PRETTY_PRINT);

    expect($serialized)->toEqual(json_encode($data, JSON_PRETTY_PRINT));
    expect($fixtureData->toFile())->toEqual($serialized);
});

test('arbitrary data can be merged in the fixture', function () {
    $response = connector()->send(new DTORequest, new MockClient([
        MockResponse::fixture('user', merge: [
            'name' => 'Sam Carré',
        ]),
    ]));

    expect($response->dto())
        ->name->toBe('Sam Carré')
        ->actualName->toBe('Sam')
        ->twitter->toBe('@carre_sam');
});
