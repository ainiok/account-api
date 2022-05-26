<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/15 15:11
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppCreateValidator;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Laravel\Passport\Client as PassportModel;

class AppController extends Controller
{

    public function index(Request $request)
    {
        return new \App\Http\Resources\AppCollection(\App\Models::paginate());
    }

    /**
     * @OA\Post(
     *     path="/admin/app",
     *     tags={"管理员"},
     *     summary="添加应用",
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(property="name",description="应用名称",type="string"),
     *               @OA\Property(property="callback",description="回调地址",type="string")
     *           )
     *       )
     *     ),
     *     @OA\Response(response="200",description="ok")
     * )
     */
    public function store(AppCreateValidator $request)
    {
        $params = $request->validated();
        $params['id'] = uuid_gen();
        $params['oauth_secret'] = Str::random(40);
        PassportModel::updateOrCreate(
            ['user_id' => $params['id']],
            [
                'name'                   => $params['name'],
                'secret'                 => $params['oauth_secret'],
                'redirect'               => $params['callback'],
                'personal_access_client' => false,
                'password_client'        => false,
                'revoked'                => false,
            ]
        );
        return self::success();
    }
}
