<?php
/**
 * Author: xiaojin
 * Email: job@ainiok.com
 * Date: 2020/12/16 15:17
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait ApiResponse
{
    /**
     * @var int
     */
    protected $statusCode = FoundationResponse::HTTP_OK;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {

        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param $data
     * @param array $header
     * @return mixed
     */
    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    /**
     * @param $status
     * @param array $data
     * @param null $code
     * @return mixed
     */
    public function status($status, array $data, $code = null)
    {

        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'success' => $status,
            'code'    => $this->statusCode
        ];

        $data = array_merge($status, $data);
        return $this->respond($data);

    }

    /**
     * @param string $message
     * @param array $data
     * @param int $code
     * @param bool $status
     * @return mixed
     */
    public function failed($message, array $data = [], $code = FoundationResponse::HTTP_BAD_REQUEST, $status = false)
    {
        return $this->setStatusCode($code)->message($message, $data, $status);
    }

    /**
     * @param mixed $message
     * @param array $data
     * @param string $status
     * @return mixed
     */
    public function message($message, $data = [], $status = "success")
    {
        $response['message'] = $message;

        $response = array_merge($response, $data);
        return $this->status($status, $response);
    }

    /**
     * 内部服务器错误
     *
     * @param string $message
     * @return mixed
     */
    public function internalError($message = "Internal Error!")
    {
        return $this->failed($message, [], FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 未认证
     *
     * @param string $message
     * @return mixed
     */
    public function unauthorized($message = "Unauthenticated.")
    {

        return $this->failed($message, [], FoundationResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * 未授权访问
     *
     * @param string $message
     * @return mixed
     */
    public function forbidden($message = "this action is unauthorized!")
    {
        return $this->failed($message, [], FoundationResponse::HTTP_FORBIDDEN);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function created($message = "created")
    {
        return $this->setStatusCode(FoundationResponse::HTTP_CREATED)
            ->message($message);
    }

    /**
     * @param array $data
     * @param bool $status
     * @return mixed
     */
    public function success($data = [], $status = true)
    {
        if ($data instanceof ResourceCollection) {
            $data = $data->resolve();
        }
        return $this->status($status, isset($data['data']) ? $data : compact('data'));
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message, [], Foundationresponse::HTTP_NOT_FOUND);
    }

}
