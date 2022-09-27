<?php declare(strict_types=1);

namespace JoeCianflone\ModelAttributes\Support;

class TransformModelAttributes
{
    private array $state = [
        'assignable' => [],
        'primary' => [
            'name' => 'id',
            'type' => 'int',
            'incrementing' => true,
        ],
        'cast' => [],
        'hidden' => [],
        'fill' => [],
        'fillable' => [],
        'guard' => [],
        'guarded' => [],
        'value' => [],
    ];

    public function __construct(
        private readonly array $attributes,
        private readonly ?bool $incrementing = null,
    ) {
    }

    public function transform(): mixed
    {
        return collect($this->attributes)->reduce(function ($carry, $value, $key) {
            $carry['assignable'][] = is_int($key) ? $value : $key;
            if (! is_int($key)) {
                $carry = collect($value)->reduce(function ($c, $v, $k) use ($key) {
                    match (true) {
                        $k === 'primary' => $c['primary'] = $this->setPrimaryKey($key, $v, $this->incrementing),
                        $k === 'cast', $k === 'value' => $c[$k][$key] = $v,
                        default => $c[$v][] = $key,
                    };

                    return $c;
                }, $carry);
            }

            return $carry;
        }, $this->state);
    }

    private function setPrimaryKey(string $name, ?string $type, ?bool $incrementing)
    {
        $type = is_null($type) || $type === 'auto' ? 'int' : (($type === 'uuid') ? 'string' : $type);
        return [
            'name' => $name,
            'type' => $type,
            'incrementing' => $incrementing ?? $type === 'int' ? true : false,
        ];
    }
}
