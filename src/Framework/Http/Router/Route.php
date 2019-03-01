<?php

namespace Framework\Http\Router;

class Route
{
    private $name;
    private $pattern;
    private $handler;
    private $tokens;
    private $methods;

    public function __construct($name, $pattern, $handler, array $methods, array $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->tokens = $tokens;
        $this->methods = $methods;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @return mixed
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param mixed $handler
     */
    public function setHandler($handler): void
    {
        $this->handler = $handler;
    }

    /**
     * @param mixed $methods
     */
    public function setMethods($methods): void
    {
        $this->methods = $methods;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @param mixed $pattern
     */
    public function setPattern($pattern): void
    {
        $this->pattern = $pattern;
    }

    /**
     * @param mixed $tokens
     */
    public function setTokens($tokens): void
    {
        $this->tokens = $tokens;
    }
}