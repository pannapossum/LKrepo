<?php namespace App\Services\Item;

use App\Services\Service;

use DB;

class DialogueService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Dialogue Service
    |--------------------------------------------------------------------------
    |
    | Handles the editing and usage of Dialogue type items.
    |
    */

    /**
     * Get the template data in a preferred format.
     */
    public function getTemplate($tag) {
        return $tag->data['pure_html'];
    }

}