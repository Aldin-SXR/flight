<?php

/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2019, Aldin Kovačević <aldin@tribeos.io>
 * @license     MIT, http://flightphp.com/license
 */

namespace flight\util;

class Util {
    /**
     * Sanitize MongoDB queries.
     * Remove any array keys starting with a dollar sign ($), to prevent possible MongoDB injection.
     * @param array $data Data to be filtered.
     * @static
     * @return array Filtered data.
     */
    public static function mongo_sanitize(&$data) {
        foreach ($data as $key => $item) {
            is_array($item) && !empty($item) && $data[$key] = self::mongo_sanitize($item);
            if (is_array($data) && preg_match('/^\$/', $key)) {
                unset($data[$key]);
            }
        }
        return $data;
    }

}