<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request)
    {
        $user = $this->getUser($request);

        $name = $user->getAttribute('name');

        return response('User Name: ' . $name);
    }

    public function purchased(Request $request)
    {
        $user = $this->getUser($request);

        $purchased = $user
            ->select('products.name')
            ->join('purchased', 'users.id', '=', 'purchased.user_id')
            ->join('products', 'purchased.product_sku', '=', 'products.sku')
            ->where(['users.id' => $user->getAttribute('id')])
            ->get();

        return $purchased;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    private function getUser(Request $request)
    {
        $id = $request->header('id');

        $users = User::query()->where(['id' => $id])->get();

        if (count($users) === 0) {
            response('User Not Found by id: ' . $id);
        }

        $user = $users[0];
        return $user;
    }
}
