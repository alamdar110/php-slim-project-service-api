<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TenderEnquiryRepository;
use InvalidArgumentException;

final class TenderEnquiryService
{
    private const STATUSES = ['draft', 'sent', 'viewed', 'quoted', 'closed'];

    public function __construct(private readonly TenderEnquiryRepository $enquiries)
    {
    }

    public function create(int $projectId, array $input): array
    {
        if (empty($input['package_name']) || empty($input['recipient_email'])) {
            throw new InvalidArgumentException('Package name and recipient email are required.');
        }

        return $this->enquiries->create($projectId, $input);
    }

    public function updateStatus(int $id, array $input): array
    {
        $status = $input['status'] ?? null;
        if (!in_array($status, self::STATUSES, true)) {
            throw new InvalidArgumentException('Invalid tender enquiry status.');
        }

        return $this->enquiries->updateStatus($id, $status);
    }
}
