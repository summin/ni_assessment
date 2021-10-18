<?php
/**
 * LoginController.php
 *
 * @author Aleksandr Leontjev <a.leontjev@pyrexx.com>
 * @copyright 2021 Pyrexx GmbH
 */


namespace App\Http\Controllers;


use App\Models\User;
use App\Service\System\FixtureMigration;
use Illuminate\Http\Request;

class LoginController
{
    public function authenticate(Request $request)
    {
        FixtureMigration::insert();

        $users = User::query()->where(
            [
                'email' => $request->post('email'),
                'password' => $request->post('password')
            ]
        )->get();

        if (count($users) === 0) {
            response('email or password is invalid, try again');
        }

        /** @var User $user */
        $user = $users[0];
        $token = sprintf('%05d', rand(1,9999));
        $userId = $user->getAttribute('id');

        $user->setAttribute('token', $token);
        $user->save();

        return response(
            "id: $userId, token: $token \n"
            . "curl command: curl -X GET --header 'id: $userId' --header 'token: $token'"
            .' http://localhost:8099/' . "\n",
        );
    }
}