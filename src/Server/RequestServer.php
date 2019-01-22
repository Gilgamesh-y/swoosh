<?php

namespace Src\Server;

use Src\App;
use Swoole\Http\Request;
use Swoole\Http\Response;

class RequestServer
{
    public $request;
    public $response;

    public function get($key = null)
    {
        if (is_null($key)) {
            return $this->request;
        }

        $arr = array_merge($this->request->post ?? [], $this->request->get ?? []);
        if (isset($arr[$key])) {
            return $arr[$key];
        }
    }

    public function only(array $key)
    {
        $res = [];
        $arr = array_merge($this->request->post ?? [], $this->request->get ?? []);
        foreach ($key as $k) {
            if (isset($arr[$k])) {
                $res = $arr[$k];
            }
        }

        return $res;
    }

    public function all()
    {
        return array_merge($this->request->post ?? [], $this->request->get ?? []);
    }

    public function set(Request $request, Response $response)
    {
        if ($request->server['request_method'] === 'POST' && is_null($request->post) && $post_data = $request->rawContent()) {
            $request->post = json_decode($post_data, true);
        }
        $this->request = $request;
        $this->response = $response;
    }
}
