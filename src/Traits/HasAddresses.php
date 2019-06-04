<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Addressable.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Addressable\Traits;

use Artisanry\Addressable\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAddresses
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(config('laravel-addressable.models.address'), 'model');
    }

    /**
     * @param string $role
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function address(string $role, $address = null): ?Model
    {
        if (is_array($address)) {
            $address = $this->addresses()->create($address);
        }

        if ($address instanceof Model) {
            $address->role($role);
        }

        return $this->addresses()->whereRole($role)->first();
    }

    /**
     * @param string $role
     *
     * @return bool
     */
    public function hasAddress(string $role): bool
    {
        return !empty($this->address($role));
    }
}
