<?php

namespace App\Repositories;

interface IRoleRepository
{
    public function listOf();
    public function filteredListOf($excludeRoles);
    public function getUserRoles($userId);
    public function hasRole($slug);
}