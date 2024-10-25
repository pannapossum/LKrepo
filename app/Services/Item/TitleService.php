<?php

namespace App\Services\Item;

use App\Models\Character\Character;
use App\Models\Character\CharacterImageTitle;
use App\Models\Character\CharacterTitle;
use App\Services\InventoryManager;
use App\Services\Service;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TitleService extends Service {
    /*
    |--------------------------------------------------------------------------
    | Title Service
    |--------------------------------------------------------------------------
    |
    | Handles the editing and usage of title type items.
    |
    */

    /**
     * Retrieves any data that should be used in the item tag editing form.
     *
     * @return array
     */
    public function getEditData() {
        return [
            'titles' => CharacterTitle::orderBy('title')->pluck('title', 'id')->toArray(),
        ];
    }

    /**
     * Processes the data attribute of the tag and returns it in the preferred format.
     *
     * @param object $tag
     *
     * @return mixed
     */
    public function getTagData($tag) {
        return [
            'type'     => $tag->data['type'] ?? null,
            'title_ids' => $tag->data['title_ids'] ?? [],
        ];
    }

    /**
     * Processes the data attribute of the tag and returns it in the preferred format.
     *
     * @param object $tag
     * @param array  $data
     *
     * @return bool
     */
    public function updateData($tag, $data) {
        DB::beginTransaction();

        try {

            $tag->update(['data' => Arr::only($data, ['type', 'title_ids'])]);

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Acts upon the item when used from the inventory.
     *
     * @param \App\Models\User\UserItem $stacks
     * @param \App\Models\User\User     $user
     * @param array                     $data
     *
     * @return bool
     */
    public function act($stacks, $user, $data) {
        DB::beginTransaction();

        try {
            $character = Character::find($data['character_id']);
            if (!$character) {
                throw new \Exception('Character not found.');
            }
            foreach ($stacks as $key=> $stack) {
                // We don't want to let anyone who isn't the owner of the title open it,
                // so do some validation...
                if ($stack->user_id != $user->id) {
                    throw new \Exception('This item does not belong to you.');
                }

                // Next, try to delete the title item. If successful, we can start distributing rewards.
                if ((new InventoryManager)->debitStack($stack->user, 'Title Used', [
                        'data' => 'Used on '.$character->displayName,
                    ], $stack, $data['quantities'][$key])) {
                    
                    $tag = $stack->item->tag('title');
                    if ($tag->getData()['type'] == 'choice') {
                        $title = CharacterTitle::find($data['title_id']);
                        if (!$title) {
                            throw new \Exception('Title not found.');
                        }
                        CharacterImageTitle::create([
                            'character_image_id' => $character->image->id,
                            'title_id'           => $data['title_id'],
                            'data'               => [],
                        ]);
                    } else {
                        foreach ($stack->item->data['title_ids'] as $key=> $title_id) {
                            $title = CharacterTitle::find($title_id);
                            if (!$title) {
                                throw new \Exception('Title not found.');
                            }
                            CharacterImageTitle::create([
                                'character_image_id' => $character->image->id,
                                'title_id'           => $title->id,
                                'data'               => [],
                            ]);
                        }
                    }
                }
            }

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Acts upon the item when used from the inventory.
     *
     * @param array $rewards
     *
     * @return string
     */
    private function getTitleRewardsString($rewards) {
        return 'You have received: '.createRewardsString($rewards);
    }
}
