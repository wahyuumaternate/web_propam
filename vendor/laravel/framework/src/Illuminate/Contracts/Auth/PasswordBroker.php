<?php

namespace Illuminate\Contracts\Auth;

use Closure;

interface PasswordBroker
{
    /**
     * Constant representing a successfully sent reminder.
     *
     * @var string
     */
    const RESET_LINK_SENT = 'Kami sudah mengirim surel yang berisi tautan untuk mereset kata sandi Anda!';

    /**
     * Constant representing a successfully reset password.
     *
     * @var string
     */
    const PASSWORD_RESET = 'Kata sandi Anda sudah direset!';

    /**
     * Constant representing the user not found response.
     *
     * @var string
     */
    const INVALID_USER = 'Kami tidak dapat menemukan pengguna dengan alamat surel tersebut.';

    /**
     * Constant representing an invalid token.
     *
     * @var string
     */
    const INVALID_TOKEN = 'Token pengaturan ulang kata sandi tidak sah.';

    /**
     * Constant representing a throttled reset attempt.
     *
     * @var string
     */
    const RESET_THROTTLED = 'Kami tidak dapat menemukan pengguna dengan alamat surel tersebut.';

    /**
     * Send a password reset link to a user.
     *
     * @param  array  $credentials
     * @param  \Closure|null  $callback
     * @return string
     */
    public function sendResetLink(array $credentials, Closure $callback = null);

    /**
     * Reset the password for the given token.
     *
     * @param  array  $credentials
     * @param  \Closure  $callback
     * @return mixed
     */
    public function reset(array $credentials, Closure $callback);
}
