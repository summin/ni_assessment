<?php
/**
 * LoginController.php
 */


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class LoginController
{
    public function authenticate(Request $request)
    {
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