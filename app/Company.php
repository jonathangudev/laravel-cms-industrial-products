<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

/**
 * The companies JMP serves
 *
 * @author Nevin Morgan <nevins.morgan@gmail.com>
 */
class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'logo',
    ];

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->generateUuid();
        });
    }

    /**
     * Generates a uuid for the model.
     *
     * @return bool
     */
    protected function generateUuid()
    {
        if (empty($this->attributes['uuid'])) {
            $this->attributes['uuid'] = (string)Uuid::uuid4();
        }

        return true;
    }

    /**
     * Get the categories for the company.
     *
     * @return App\Catalog\Category
     */
    public function categories()
    {
        return $this->hasMany(Catalog\Category::class);
    }

    /**
     * Get the users for the company.
     *
     * @return App\User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Return the Uuid for the company
     *
     * @param string $value
     * @return string
     */
    public function getUuidAttribute($value)
    {
        if (empty($value)) {
            $this->generateUuid();
        }

        return $this->attributes['uuid'];
    }

    /**
     * Set the Uuid for the company
     *
     * @param  string  $value
     * @return void
     */
    public function setUuidAttribute($value)
    {
        $this->generateUuid();
    }

    /**
     * Get the logo url for the company
     *
     * @return  return string
     */
    public function getLogoUrl()
    {
        return Storage::disk('restricted')->url($this->logo);
    }

    /**
     * Get all of the user login attempts for the company
     */
    public function userLogins()
    {
        return $this->hasManyThrough('App\Logs\UserLogin', 'App\User')->orderBy('created_at', 'desc');
    }
}
