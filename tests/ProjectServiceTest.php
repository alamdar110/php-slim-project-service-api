<?php

declare(strict_types=1);

namespace Tests;

use App\Repositories\ProjectRepository;
use App\Services\ProjectService;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class ProjectServiceTest extends TestCase
{
    public function testItRejectsMissingProjectName(): void
    {
        $repository = $this->createMock(ProjectRepository::class);
        $service = new ProjectService($repository);

        $this->expectException(InvalidArgumentException::class);

        $service->create(['customer_name' => 'Demo Customer']);
    }

    public function testItCreatesProjectWithDraftStatusByDefault(): void
    {
        $repository = $this->createMock(ProjectRepository::class);
        $repository->expects($this->once())
            ->method('create')
            ->with([
                'name' => 'Demo Project',
                'customer_name' => 'Demo Customer',
                'status' => 'draft',
            ])
            ->willReturn(['id' => 1, 'name' => 'Demo Project']);

        $service = new ProjectService($repository);
        $result = $service->create([
            'name' => 'Demo Project',
            'customer_name' => 'Demo Customer',
        ]);

        $this->assertSame(1, $result['id']);
    }
}
