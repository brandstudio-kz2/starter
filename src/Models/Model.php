<?php

namespace BrandStudio\Starter\Models;

use Illuminate\Database\Eloquent\Model as OriginalModel;
use BrandStudio\Publishable\Interfaces\Publishable;
use BrandStudio\Identifiable\Interfaces\Identifiable;

class Model extends OriginalModel implements Publishable, Identifiable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use \BrandStudio\File\Traits\HasFile;
    use \BrandStudio\Publishable\Traits\Publishable;
    use \BrandStudio\Identifiable\Traits\Identifiable;


    public function sluggable() : array
    {
        return [
            'slug' => [
                'source' => 'slug_or_name',
                'onUpdate' => true,
            ],
        ];
    }

    public function getSlugOrNameAttribute()
    {
        if ($this->slug) {
            return $this->slug;
        }
        return $this->identifiableName;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? $this->getRouteKeyName(), $value)->beforeRouteBinding($value, $field)->firstOrFail();
    }

}
