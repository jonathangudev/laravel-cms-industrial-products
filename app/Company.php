<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
            $this->attributes['uuid'] = (string) Uuid::uuid4();
        }

        if (is_null($this->attributes['uuid'])) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * Get the users for the company.
     *
     * @return App\Company\User
     */
    public function users()
    {
        return $this->hasMany(Company\User::class);
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
}
