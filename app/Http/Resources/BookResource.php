<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'title' => $this->name,
            'ISBN' => $this->ISBN,
            'price' => $this->formatBrazilianCurrency($this->value),
            'creation date' => Carbon::parse($this->created_at)->diffForHumans(),
            'last update' => Carbon::parse($this->updated_at)->diffForHumans(),


        ];
    }

    protected function formatBrazilianCurrency($value): string | float
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
}
