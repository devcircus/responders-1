<?php

namespace PerfectOblivion\Responder;

use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Responsable;

abstract class Responder implements Responsable
{
    /** @var mixed */
    protected $payload;

    /** @var \Illuminate\Http\Request */
    protected $request;

    /**
     * Construct a new base Responder.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        return $this->respond();
    }

    /**
     * Send a response.
     *
     * @return mixed
     */
    abstract public function respond();

    /**
     * Add the payload to the response.
     *
     * @param  mixed  $payload
     *
     * @return $this
     */
    public function withPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Add the request to the response. Allows FormRequest objects to be added to the responder.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return $this
     */
    public function withRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}
