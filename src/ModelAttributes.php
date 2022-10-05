<?php declare(strict_types=1);

namespace JTC\ModelAttributes;

use JC\ModelAttributes\Support\TransformModelAttributes;

#[\Attribute(\Attribute::TARGET_CLASS)]
class ModelAttributes
{
    public readonly array $attrs;

    public function __construct(
        public readonly array $attributes = [],
        public readonly ?bool $incrementing = null,
        public readonly string $protection = 'any',
    ) {
        $this->attrs = (new TransformModelAttributes(
            attributes: $this->attributes,
            incrementing: $this->incrementing,
        ))->transform();
    }

    public function getGuardedAttributes(): array
    {
        return match ($this->protection) {
            'limited' => array_merge($this->attrs['guarded'], $this->attrs['guard']),
            'disable' => [],
            default => ['*']
        };
    }

    public function getFillableAttributes(): array
    {
        return match ($this->protection) {
            'limited', 'full', 'disable' => [],
            default => array_merge($this->attrs['fillable'], $this->attrs['fill'])
        };
    }
}
