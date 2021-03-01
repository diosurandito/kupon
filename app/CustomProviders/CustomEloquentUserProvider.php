<?php

namespace App\CustomProviders;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

/**
 * 
 */
class CustomEloquentUserProvider extends EloquentUserProvider
{
	
	/**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
	public function validateCredentials(UserContract $user, array $credentials)
	{
		$plain = $credentials['password'];

		return hash('md5', $plain)===$user->getAuthPassword();

		//return $this->hasher->check($plain, $user->getAuthPassword());
	}
}