<?php

namespace App\Models\Character;

use App\Models\Model;
use App\Models\Rarity;
use App\Models\Species\Species;
use App\Models\Species\Subtype;
use App\Models\User\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class CharacterImage extends Model {
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_id', 'user_id', 'species_id', 'subtype_id', 'rarity_id', 'url',
        'extension', 'use_cropper', 'hash', 'fullsize_hash', 'fullsize_extension', 'sort',
        'x0', 'x1', 'y0', 'y1',
        'description', 'parsed_description',
        'is_valid', 'label', 'transformation_id','transformation_info','transformation_description',
        'sex', 'colours',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_images';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**
     * Validation rules for image creation.
     *
     * @var array
     */
    public static $createRules = [
        'species_id' => 'required',
        'rarity_id'  => 'required',
        'image'      => 'required|mimes:jpeg,jpg,gif,png,webp|max:2048',
        'thumbnail'  => 'nullable|mimes:jpeg,jpg,gif,png,webp|max:2048',
    ];

    /**
     * Validation rules for image updating.
     *
     * @var array
     */
    public static $updateRules = [
        'character_id' => 'required',
        'user_id'      => 'required',
        'species_id'   => 'required',
        'rarity_id'    => 'required',
        'description'  => 'nullable',
        'image'        => 'mimes:jpeg,jpg,gif,png,webp|max:2048',
        'thumbnail'    => 'nullable|mimes:jpeg,jpg,gif,png,webp|max:2048',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character associated with the image.
     */
    public function character() {
        return $this->belongsTo(Character::class, 'character_id');
    }

    /**
     * Get the user who owned the character at the time of image creation.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the species of the character image.
     */
    public function species() {
        return $this->belongsTo(Species::class, 'species_id');
    }

    /**
     * Get the subtype of the character image.
     */
    public function subtype() {
        return $this->belongsTo(Subtype::class, 'subtype_id');
    }

    /**
     * Get the rarity of the character image.
     */
    public function rarity() {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    /**
     * Get the title of the character image.
     */
    public function titles() {
        return $this->hasMany(CharacterImageTitle::class, 'character_image_id');
    }

    /**
     * Get the features (traits) attached to the character image, ordered by display order.
     */
    public function features() {
        $query = $this
            ->hasMany(CharacterFeature::class, 'character_image_id')->where('character_features.character_type', 'Character')
            ->join('features', 'features.id', '=', 'character_features.feature_id')
            ->leftJoin('feature_categories', 'feature_categories.id', '=', 'features.feature_category_id')
            ->select(['character_features.*', 'features.*', 'character_features.id AS character_feature_id', 'feature_categories.sort']);

        return $query->orderByDesc('sort');
    }

    /**
     * Get the designers/artists attached to the character image.
     */
    public function creators() {
        return $this->hasMany(CharacterImageCreator::class, 'character_image_id');
    }

    /**
     * Get the designers attached to the character image.
     */
    public function designers() {
        return $this->hasMany(CharacterImageCreator::class, 'character_image_id')->where('type', 'Designer')->where('character_type', 'Character');
    }

    /**
     * Get the artists attached to the character image.
     */
    public function artists() {
        return $this->hasMany(CharacterImageCreator::class, 'character_image_id')->where('type', 'Artist')->where('character_type', 'Character');
    }

    /**
     * Get the transformation of the character image.
     */
    public function transformation() {
        return $this->belongsTo('App\Models\Character\CharacterTransformation', 'transformation_id');
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include images visible to guests and regular logged-in users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeImages($query, $user = null) {
        if (!$user || !$user->hasPower('manage_characters')) {
            return $query->where('is_visible', 1)->orderBy('sort')->orderBy('id', 'DESC');
        } else {
            return $query->orderBy('sort')->orderBy('id', 'DESC');
        }
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
    public function getImageDirectoryAttribute() {
        return 'images/characters/'.floor($this->id / 1000);
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
    public function getImageFileNameAttribute() {
        return $this->id.'_'.$this->hash.'.'.$this->extension;
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
    public function getImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
    public function getImageUrlAttribute() {
        return asset($this->imageDirectory.'/'.$this->imageFileName);
    }

    /**
     * Gets the file name of the model's fullsize image.
     *
     * @return string
     */
    public function getFullsizeFileNameAttribute() {
        // Backwards compatibility pre v3
        return $this->id.'_'.$this->hash.'_'.$this->fullsize_hash.'_full.'.($this->fullsize_extension ?? $this->extension);
    }

    /**
     * Gets the file name of the model's fullsize image.
     *
     * @return string
     */
    public function getFullsizeUrlAttribute() {
        return asset($this->imageDirectory.'/'.$this->fullsizeFileName);
    }

    /**
     * Gets the file name of the model's fullsize image.
     *
     * @param  User
     * @param mixed|null $user
     *
     * @return string
     */
    public function canViewFull($user = null) {
        if (((isset($this->character->user_id) && ($user ? $this->character->user->id == $user->id : false)) || ($user ? $user->hasPower('manage_characters') : false))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Gets the file name of the model's thumbnail image.
     *
     * @return string
     */
    public function getThumbnailFileNameAttribute() {
        return $this->id.'_'.$this->hash.'_th.'.$this->extension;
    }

    /**
     * Gets the path to the file directory containing the model's thumbnail image.
     *
     * @return string
     */
    public function getThumbnailPathAttribute() {
        return $this->imagePath;
    }

    /**
     * Gets the URL of the model's thumbnail image.
     *
     * @return string
     */
    public function getThumbnailUrlAttribute() {
        return asset($this->imageDirectory.'/'.$this->thumbnailFileName);
    }

    /**
     * Gets the label attribute as an object.
     *
     * @return string
     */
    public function getLabelAttribute() {
        return json_decode($this->attributes['label'], true);
    }
    /** 
     * Gets the URL of the model's thumbnail image.
     *
     * @return string
     */
    public function displayColours() {
        // return the images as a row of colour boxes
        if (!$this->colours) {
            return '';
        }

        $is_myo = $this->character->is_myo_slot;
        $colours = json_decode($this->colours, true);
        $display_colours = [];

        // we will always display the blocks, but if blending is enabled, we will also display the gradient
        $block_colours = [];
        foreach ($colours as $key=>$colour) {
            $block_colours[] = '<div style="background-color: '.$colour.'; width: 20px; height: 20px; display: inline-block; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd;'
            .($key == 0 ? 'border-left: 1px solid #ddd;' : '').($key == count($colours)-1 ? 'border-right: 1px solid #ddd;' : '').'"></div>';
        }
        $display_colours[] = ($is_myo ? '<div class="row">' : '').implode(' ', $block_colours).($is_myo ? '</div>' : '');

        // characters never have blended colours, so they can be displayed as blocks
        if (!$is_myo) {
            return implode(' ', $display_colours);
        } else {
            // if blending is enabled, we will also display the gradient
            if (config('lorekeeper.character_pairing.blend_colours')) {
                $display_colours[] = '<div class="row"><div style="background: linear-gradient(to right, '.implode(', ', $colours).'); width: '.config('lorekeeper.character_pairing.colour_count') * 20 * 2 .'px; height: 20px; display: inline-block;""></div></div>';
            }

            // now check if we are making alternative palettes
            if (config('lorekeeper.character_pairing.alternative_palettes')) {

                // if we are we also display the blocks for the alternative palettes
                // generate two different palettes

                $filters = [
                    'hue-rotate(25deg) saturate(1.1) brightness(1.1)',
                    'hue-rotate(-20deg) saturate(.8)',
                ];

                foreach ($filters as $filter) {
                    $display_colours[] = '<div class="row" style="filter: '.$filter.'">'. implode(' ', $block_colours).'</div>';
                    if (config('lorekeeper.character_pairing.blend_colours')) {
                        $display_colours[] = '<div class="row"><div style="background: linear-gradient(to right, '.implode(', ', $colours).'); width: '.config('lorekeeper.character_pairing.colour_count') * 20 * 2 .'px; height: 20px; display: inline-block; filter: '.$filter.'"></div></div>';
                    }
                }
            }
        }

        return implode(' ', $display_colours);
    }
    
     /** 
     *  Displays all of the images titles.
     *
     * @return string
     */
    public function getDisplayTitlesAttribute() {
        $titles = [];
        foreach ($this->titles as $title) {
            $titles[] = $title->displayTitle;
        }

        return '<div class="row">'.implode('', $titles).'</div>';
    }

    /**
     * Gets the id array of titles for select forms.
     *
     * @return string
     */
    public function getTitleIdsAttribute() {
        $ids = [];
        // we have to do foreach because null id means 'custom' title
        foreach ($this->titles as $title) {
            $ids[] = $title->title_id ?? 'custom';
        }

        return $ids;
    }
}
