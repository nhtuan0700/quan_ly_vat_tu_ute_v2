<?php

namespace App\Repositories\Role;

use App\Models\Role;
use App\Repositories\RepositoryInterface;

interface RoleInterface extends RepositoryInterface
{
	const ADMIN = Role::ADMIN;
	const HANDLER = Role::HANDLER;
}
