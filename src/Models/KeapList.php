<?php

namespace KeapGeek\Keap\Models;

use Illuminate\Support\Collection;
use KeapGeek\Keap\Services\Service;

class KeapList
{
    protected array $list;

    protected int $total;

    protected array $previous, $next;

    protected string $name;

    public function __construct(?array $data, public Service $service)
    {
        if(is_null($data)) return;

        $this->name = $this->getName($service->getUri());
        $this->total = $data['count'];
        $this->previous = $this->getQuery($data['previous']);
        $this->next = $this->getQuery($data['next']);

        $this->list = $data[$this->name];
    }

    public function toArray(): array
    {
        return $this->list;
    }

    public function toCollection(): Collection
    {
        return collect($this->list);
    }

    public function total(): int
    {
        return $this->total;
    }


    protected function getName($uri): string
    {
        $name = explode('/', $uri);
        return $name[count($name) - 1];
    }

    protected function getQuery($url): array
    {
        $query = [];
        parse_str(explode('?', $url)[1], $query);
        return $query;
    }

    public function next(): self
    {
        return $this->service->list($this->next);
    }

    public function previous(): self
    {
        return $this->service->list($this->previous);
    }
}
