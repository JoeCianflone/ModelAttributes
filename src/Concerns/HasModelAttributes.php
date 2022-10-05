<?php declare(strict_types=1);

namespace JTC\ModelAttributes\Concerns;

use Crell\AttributeUtils\Analyzer;
use JC\ModelAttributes\ModelAttributes;

trait HasModelAttributes
{
    protected function initializeHasModelAttributes(): void
    {
        $analyzer = new Analyzer();
        $modelAttributes = $analyzer->analyze(__CLASS__, ModelAttributes::class);

        // Set the Primary key defaults to ID of int
        $this->keyType = $modelAttributes->attrs['primary']['type'];
        $this->primaryKey = $modelAttributes->attrs['primary']['name'];

        // Incrementing if not an 'int' or 'auto' set to false
        $this->incrementing = $modelAttributes->attrs['primary']['incrementing'];

        // // Set attributes with default values
        $this->attributes = $modelAttributes->attrs['value'];

        // // Set any hidden and casts
        $this->setHidden($modelAttributes->attrs['hidden']);

        $casts = $modelAttributes->attrs['cast'];
        if ($modelAttributes->attrs['primary']['type'] !== 'int') {
            $casts[$modelAttributes->attrs['primary']['name']] = $modelAttributes->attrs['primary']['type'];
        }

        $this->mergeCasts($casts);
        $this->guard($modelAttributes->getGuardedAttributes());
        $this->mergeFillable($modelAttributes->getFillableAttributes());
    }
}
