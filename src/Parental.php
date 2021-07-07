<?php

namespace Wamadev\NovaParentalField;

use Laravel\Nova\Fields\ResourceRelationshipGuesser;
use Laravel\Nova\Fields\Select;

class Parental extends Select
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'parental-field';

    public function __construct($name = 'Type', ...$otherFields)
    {
        $this->parent();
        parent::__construct(...func_get_args());
    }

    /**
     * Gets the children list from model class and appends it to meta
     *
     * @var string
     */
    public function parent($modelClass = null)
    {
        // Gets the model that has called this resource
        if (!isset($modelClass)) {
            $resource = request()->route('resource');
            if (!$resource) return;
            $novaResourceClass = ResourceRelationshipGuesser::guessResource($resource);
            $novaResourceInstance = (new $novaResourceClass(request()->route($resource)));
            $modelClass = $novaResourceInstance::$model;
        }

        $options = (new $modelClass)->getChildTypes();

        $this->withMeta([
            'options' => collect($options ?? [])->map(function ($label, $value) {
                return ['label' => $label, 'value' => $value];
            })->values()->all(),
        ]);

        return $this;
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        if (!isset($this->meta['options'])) {
            throw new \Exception("This field should either be called in a Nova resource or be called `parent()` on (See nova-parental docs)");
        }

        return parent::jsonSerialize();
    }
