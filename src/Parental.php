<?php

namespace Wama\NovaParentalField;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\ResourceRelationshipGuesser;
use Laravel\Nova\Fields\Select;
use Illuminate\Support\Str;

class Parental extends Select
{
    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|callable|null  $attribute
     * @param  callable|null  $resolveCallback
     * @return void
     */
    public function __construct($name = null, $attribute = null, ...$otherInputs)
    {
        $modelInstance = $this->getModelInstance();

        if (!$attribute) {
            $attribute = class_basename($modelInstance->getInheritanceColumn());
        }

        if (!$name) {
            $name = __(Str::title($attribute));
        }

        $this->options(collect($modelInstance->getChildTypes())->map(function($value, $key) {
            return __(Str::title($key)) . " (" . $value . ")";
        }));

        parent::__construct($name, $attribute, ...$otherInputs);
    }

    /**
     * Returns a model instance, if no class given automatically guesses it
     *
     * @param string|null
     * @return Model
     */
    private function getModelInstance($modelClass = null)
    {
        // Gets the model that has called this resource
        if (!isset($modelClass)) {
            $modelClass = $this->guessClass();
        }

        return new $modelClass;
    }

    /**
     * Guesses the model class
     * NOTE: this will probably be refactored when i find a better way of doing it.
     *
     * @return string
     */
    private function guessClass()
    {
        $resource = request()->route('resource');
        if (!$resource) return;
        $novaResourceClass = ResourceRelationshipGuesser::guessResource($resource);
        $novaResourceInstance = (new $novaResourceClass(request()->route($resource)));
        return $novaResourceInstance::$model;
    }
}
