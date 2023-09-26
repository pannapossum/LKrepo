<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\TemplateTag;

class TemplateService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Template Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of template tags.
    |
    */

    /**********************************************************************************************

        TEMPLATE TAGS

    **********************************************************************************************/


    /**
     * Creates a template tag.
     *
     * @param  \App\Models\Template\Template  $template
     * @param  string                 $tag
     * @return string|bool
     */
    public function createTemplate($data)
    {
        DB::beginTransaction();

        try {
            if(TemplateTag::where('name', $data['name'])->exists()) throw new \Exception("This template name already exists.");

            $tag = TemplateTag::create([
                'name' => $data['name'],
                'tag' => $data['tag']
            ]);

            return $this->commitReturn($tag);
        } catch(\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    
    /**
     * Updates a template tag.
     */
    public function updateTemplate($template, $data)
    {
        DB::beginTransaction();

        try {
            if(TemplateTag::where('name', $data['name'])->where('id', '!=', $template->id)->exists()) throw new \Exception("This template name already exists.");
            $template->update($data);

            return $this->commitReturn($template);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    
}
