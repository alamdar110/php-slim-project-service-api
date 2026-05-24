<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TeamMemberRepository;
use InvalidArgumentException;

final class TeamMemberService
{
    private const ALLOWED_ROLES = ['owner', 'manager', 'qs', 'viewer'];

    public function __construct(private readonly TeamMemberRepository $teamMembers)
    {
    }

    public function add(int $projectId, array $input): array
    {
        if (empty($input['email']) || empty($input['role'])) {
            throw new InvalidArgumentException('Email and role are required.');
        }

        if (!in_array($input['role'], self::ALLOWED_ROLES, true)) {
            throw new InvalidArgumentException('Unsupported project role.');
        }

        return $this->teamMembers->create($projectId, $input);
    }
}
