<?php

namespace App\Services;

use App\Helpers\Responses;
use App\User;
use Illuminate\Support\Facades\Auth;
use ReflectionClass;

/**
 * Class Service
 * @package App\Services
 *
 * @property PostService $postService
 */
abstract class Service
{
    use Responses;

    public function __get($name)
    {
        $child = (new ReflectionClass(self::class))->getNamespaceName() . '\\' . ucfirst($name);
        if (class_exists($child)) {
            return new $child;
        }

        return null;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        /** @var User $user */
        $user = Auth::user();
        return $user;
    }
}
