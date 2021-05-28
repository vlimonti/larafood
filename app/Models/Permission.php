<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * Get Profiles
     */
    public function profiles(){
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Profiles not linked with this permission
    */
    public function profilesAvailable( $filter = null )
    {
        $profiles = Profile::whereNotIn('profiles.id', function($query){
            $query->select('permission_profile.profile_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.permission_id = {$this->id}");
        })
        ->where(function ($queryFilter) use ($filter){
            if($filter)
                $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $profiles;
    }
}
