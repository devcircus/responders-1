<?php

namespace PerfectOblivion\Responder;

use Illuminate\Http\Request;
use DevMarketer\LaraFlash\LaraFlash;
use Illuminate\Contracts\Support\Responsable;

abstract class Responder implements Responsable
{
    /**
     * The response payload.
     *
     * @var mixed
     */
    protected $payload;

    /**
     * Laraflash for flashing to session.
     *
     * @var \DevMarketer\LaraFlash\LaraFlash
     */
    protected $flash;

    /**
     * Construct a new base Responder.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \DevMarketer\LaraFlash\LaraFlash  $flash
     */
    public function __construct(Request $request, LaraFlash $flash)
    {
        $this->request = $request;
        $this->flash = $flash;
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
     * Add the request to the response.
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

    /**
     * Flash data to the session.
     *
     * @param  string $key
     * @param  mixed  $value
     */
    protected function flash($message, array $options = [])
    {
        return $this->flash->add($message, $options);
    }
}
