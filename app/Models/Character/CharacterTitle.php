<?php

namespace App\Models\Character;

use App\Models\Model;
use App\Models\Rarity;

class CharacterTitle extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'short_title', 'sort', 'has_image', 'description', 'parsed_description', 'rarity_id', 'colour',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_titles';

    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'title'       => 'required|unique:character_titles|between:3,100',
        'short_title' => 'nullable|unique:character_titles|between:3,25',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'title'       => 'required|between:3,100',
        'short_title' => 'nullable|between:3,25',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the rarity of the character image.
     */
    public function rarity() {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    /**********************************************************************************************

        ATTRIBUTES

    **********************************************************************************************/

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
    public function getDisplayNameAttribute() {
        return '<a href="'.$this->url.'" class="display-rarity">'.$this->title.'</a>';
    }

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
    public function getDisplayNamePartialAttribute() {
        return '<a href="'.$this->url.'" class="display-rarity">'.$this->title.'</a>'.($this->rarity ? ' ('.$this->rarity->displayName.')' : '');
    }

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
    public function getDisplayNameFullAttribute() {
        return '<a href="'.$this->url.'" style="color: '.$this->colour.' !important;" class="display-rarity">'.$this->title.'</a>'.($this->short_title ? ' ('.$this->short_title.')' : '').($this->rarity ? ' ('.$this->rarity->displayName.')' : '');
    }

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
    public function getDisplayNameShortAttribute() {
        return '<a href="'.$this->url.'" class="display-rarity">'.$this->short_title.'</a>';
    }

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
    public function getImageDirectoryAttribute() {
        return 'images/data/character-titles';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
    public function getTitleImageFileNameAttribute() {
        return $this->id.'-image.png';
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
    public function getTitleImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
    public function getTitleImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->titleImageFileName);
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
    public function getUrlAttribute() {
        return url('world/character-titles?title='.$this->title);
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
    public function getIdUrlAttribute() {
        return url('world/character-titles/'.str_replace(' ', '-', $this->title));
    }

    /**
     * Gets the URL for a masterlist search of characters of this rarity.
     *
     * @return string
     */
    public function getSearchCharactersUrlAttribute() {
        return url('masterlist?title_id='.$this->id);
    }

    /**
     * Gets the currency's asset type for asset management.
     *
     * @return string
     */
    public function getAssetTypeAttribute() {
        return 'character_title';
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Displays the title like a typing.
     *
     * @param mixed $data
     */
    public function displayTitle($data) {
        return '<a href="'.$this->idUrl.'"><span class="badge ml-1" style="color: white; background-color: '.$this->colour.';"'.
            (isset($data['full']) ? ' data-toggle="tooltip" title="'.$this->title.'">'.$data['full'] : '>'.$this->title)
        .'</span></a>';
    }
}
