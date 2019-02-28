<?php

namespace App\Events\Catalog\Product;

use App\Catalog\Product\AttributeValue;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttributeValueCreating
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var AttributeValue $attributeValue
     */
    public $attributeValue;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(AttributeValue $attributeValue)
    {
        $this->attributeValue = $attributeValue;
    }
}
