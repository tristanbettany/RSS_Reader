<?php

namespace RSSReader\Presentation;

use RSSReader\ApplicationInterface\ResponseInterface;

/**
 * Template Class
 */
final class Template
{
    /**
     * @param ResponseInterface $response
     */
    public static function render(ResponseInterface $response)
    {
        if ($response->getType() === 'JSON') {
            self::renderJSON($response);
        }

        if ($response->getType() === 'HTML') {
            self::renderHTML($response);
        }
    }

    /**
     * @param ResponseInterface $response
     */
    private static function renderJSON(ResponseInterface $response)
    {
        http_response_code($response->getCode());
        header('Content-Type: application/json');

        echo json_encode($response->getData());
    }

    /**
     * @param ResponseInterface $response
     */
    private static function renderHTML(ResponseInterface $response)
    {
        http_response_code($response->getCode());

        $vars = $response->getData();

        include_once __DIR__ . '/Templates/' . $response->getTemplate() . '.php';
    }
}