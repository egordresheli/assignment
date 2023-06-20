<?php

namespace Tests\Feature;

use App\Domain\Containers\Models\Container;
use App\Domain\Objects\Models\Circle;
use App\Domain\Objects\Models\Square;
use Tests\TestCase;

class ShipmentsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Container::factory()->create(['name' => 'big', 'width' => 300, 'length' => 200]);
        Container::factory()->create(['name' => 'small', 'width' => 100, 'length' => 100]);
    }

    /** @test */
    public function calculate_containers_with_first_transport(): void
    {
        $circles = Circle::factory()->count(2)->create(['radius' => 50])->toArray();
        $square = Square::factory()->create(['width' => 100, 'length' => 100])->toArray();

        $response = $this->post('api/shipments/count-containers', [
            'squares' => [$square],
            'circles' => $circles
        ]);
        echo  "Response is: " . $response->getContent() . "\n";

        $response->assertStatus(200, "Response is: " . $response->getContent());
    }

    /** @test */
    public function calculate_containers_with_second_transport(): void
    {
        $circle = Circle::factory()->create(['radius' => 100])->toArray();
        $square = Square::factory()->create(['width' => 400, 'length' => 400])->toArray();

        $response = $this->post('api/shipments/count-containers', [
            'squares' => [$square],
            'circles' => [$circle]
        ]);
        echo  "Response is: " . $response->getContent() . "\n";
        $response->assertStatus(200);
    }

    /** @test */
    public function calculate_containers_with_third_transport(): void
    {
        $circle = Circle::factory()->create(['radius' => 50])->toArray();
        $firstSquare = Square::factory()->create(['width' => 150, 'length' => 100])->toArray();
        $secondSquare = Square::factory()->create(['width' => 50, 'length' => 50])->toArray();

        $response = $this->post('api/shipments/count-containers', [
            'squares' => [$firstSquare, $secondSquare],
            'circles' => [$circle]
        ]);
        echo  "Response is: " . $response->getContent() . "\n";
        $response->assertStatus(200);
    }
}
