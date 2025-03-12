<?php

namespace App\Models\Character;

use App\Models\Model;

class CharacterImageTitle extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_image_id', 'title_id', 'data',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_image_titles';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character image.
     */
    public function image() {
        return $this->belongsTo(CharacterImage::class, 'character_image_id');
    }

    /**
     * Get the title.
     */
    public function title() {
        return $this->belongsTo(CharacterTitle::class, 'title_id');
    }

    /**********************************************************************************************

        ATTRIBUTES

    **********************************************************************************************/

    /**
     * Displays the title.
     *
     * @return string
     */
    public function getDisplayTitleAttribute() {
        if ($this->title_id) {
            return $this->title->displayTitle($this->data);
        }

        return '<div><span class="badge ml-1" style="color: white; background-color: #ddd;">'.($this->data['short'] ?? $this->data['full']).'</span></div>';
    }
}
