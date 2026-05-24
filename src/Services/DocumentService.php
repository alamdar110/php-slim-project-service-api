<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\DocumentRepository;
use InvalidArgumentException;

final class DocumentService
{
    public function __construct(private readonly DocumentRepository $documents)
    {
    }

    public function attach(int $tenderEnquiryId, array $input): array
    {
        foreach (['filename', 'storage_key', 'mime_type'] as $field) {
            if (empty($input[$field])) {
                throw new InvalidArgumentException("Missing document field: {$field}");
            }
        }

        return $this->documents->create($tenderEnquiryId, $input);
    }
}
