<?php

declare(strict_types=1);

namespace App\Api;

use JsonException;

final class JSON
{
    /**
     * Encoding options
     */
    public const ENCODING_OPTIONS =
        JSON_UNESCAPED_SLASHES |
        JSON_UNESCAPED_UNICODE |
        JSON_UNESCAPED_LINE_TERMINATORS;

    /**
     * Encode a value as JSON
     *
     * @param  array<string|int,mixed>  $value
     *
     * @return string
     * @throws JsonException
     */
    public static function encode(array $value) : string
    {
        return json_encode($value, self::ENCODING_OPTIONS | JSON_THROW_ON_ERROR);
    }

    /**
     * Decode JSON data
     *
     * @param  string  $data
     *
     * @return array<string|int,mixed>
     * @throws JsonException
     */
    public static function decode(string $data) : array
    {
        return json_decode($data, true, 512, JSON_THROW_ON_ERROR);
    }
}
