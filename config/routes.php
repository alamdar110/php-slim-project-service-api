<?php

declare(strict_types=1);

use App\Controllers\DocumentController;
use App\Controllers\HealthController;
use App\Controllers\ProjectController;
use App\Controllers\TeamMemberController;
use App\Controllers\TenderEnquiryController;
use Slim\App;

return function (App $app): void {
    $app->get('/health', [HealthController::class, 'show']);

    $app->get('/api/projects', [ProjectController::class, 'index']);
    $app->post('/api/projects', [ProjectController::class, 'store']);
    $app->get('/api/projects/{id}', [ProjectController::class, 'show']);

    $app->post('/api/projects/{id}/team-members', [TeamMemberController::class, 'store']);
    $app->post('/api/projects/{id}/tender-enquiries', [TenderEnquiryController::class, 'store']);
    $app->patch('/api/tender-enquiries/{id}/status', [TenderEnquiryController::class, 'updateStatus']);
    $app->post('/api/tender-enquiries/{id}/documents', [DocumentController::class, 'store']);
};
