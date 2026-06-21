# CloudBox

CloudBox is a Laravel-based multi-tenant cloud storage platform built for managing files, folders, and secure sharing across different tenants.

## Features

- User authentication
- Multi-tenant file isolation
- File upload, download, and delete
- Folder management
- Storage usage dashboard
- Public share links
- Laravel Sail Docker setup

## Tech Stack

- Laravel
- MySQL
- Blade
- Tailwind CSS
- Laravel Breeze
- Docker / Laravel Sail

## Local Setup

```bash
git clone git@github.com:AminZahin/cloudbox.git
cd cloudbox
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
