<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use ReflectionClass;
use ReflectionException;

trait RecordsActivity
{
    /**
     * Boot the trait.
     */
    protected static function bootRecordsActivity()
    {
        if (auth()->guest()) return;
        foreach (static::getRecordEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        static::deleting(function ($model) {
            $model->activity()->delete();
        });

    }

    /**
     * События, которые требуют записи.
     *
     * @return array
     */
    protected static function getRecordEvents()
    {
        return ['created'];
    }

    /**
     *  Record new activity for the model.
     * Запись новой активности для модели.
     * @param string $event
     * @throws ReflectionException
     */
    protected function recordActivity($event)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event)
        ]);
    }

    /**
     * Fetch the activity relationship.
     * Получить отношение активности
     * @return MorphMany
     */
    public function activity()
    {
        return $this->morphMany('App\Models\Activity', 'subject');
    }

    /**
     * Determine the activity type.
     * Определить тип активности
     * @param string $event
     * @return string
     * @throws ReflectionException
     */
    protected function getActivityType($event)
    {
        $type = strtolower((new ReflectionClass($this))->getShortName());
        return "{$event}_{$type}";
    }

}
