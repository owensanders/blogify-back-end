<?php

namespace App\Interfaces;

use App\Models\User;

interface DashboardRepositoryInterface
{
    public function get(): array;
}
