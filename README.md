# PHP Slim Project Service API

A PHP 8 + Slim backend demo for project workflow APIs. It shows clean REST API structure, service/repository layering, Docker setup, database migrations, and PHPUnit tests.

## Why This Project Exists

This repository demonstrates backend API engineering in a generic, reviewable form:

- PHP 8 API service structure
- Slim-style routing and controllers
- REST API design
- project, tender, document, and team workflows
- repository/service layering
- Docker-based local setup
- database migrations and seed data
- PHPUnit test structure
- clean documentation for recruiters and engineering reviewers

## Tech Stack

- PHP 8.2
- Slim Framework
- MySQL
- PDO
- Docker and Docker Compose
- PHPUnit
- Composer

## Features

- Project CRUD APIs
- Tender enquiry creation and status updates
- Document metadata attachment to projects and enquiries
- Team member role assignment
- Simple permission checks for project actions
- Operational audit log model
- Health check endpoint

## API Overview

| Method | Endpoint | Purpose |
| --- | --- | --- |
| GET | `/health` | Service health check |
| GET | `/api/projects` | List projects |
| POST | `/api/projects` | Create a project |
| GET | `/api/projects/{id}` | View a project |
| POST | `/api/projects/{id}/team-members` | Add project team member |
| POST | `/api/projects/{id}/tender-enquiries` | Create tender enquiry |
| PATCH | `/api/tender-enquiries/{id}/status` | Update tender enquiry status |
| POST | `/api/tender-enquiries/{id}/documents` | Attach document metadata |

## Local Setup

```bash
cp .env.example .env
docker compose up -d --build
docker compose exec app php database/migrate.php
docker compose exec app php database/seed.php
```

The API will be available at:

```text
http://localhost:8088
```

## Run Tests

```bash
docker compose exec app composer test
```

## Example Request

```bash
curl -X POST http://localhost:8088/api/projects \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Operations Rollout",
    "customer_name": "Demo Operations Ltd",
    "status": "active"
  }'
```

## Architecture

```text
public/index.php
  -> config/routes.php
  -> Controllers
  -> Services
  -> Repositories
  -> Database
```

The service layer owns business rules, repositories own persistence, and controllers keep request/response handling thin.

## Notes

This project uses demo data only and is intended for portfolio review and local experimentation.
