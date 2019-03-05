<?php

namespace App\Listeners\Catalog\Product;

use App\Catalog\Product\AttributeValue;
use App\Events\Catalog\Product\AttributeValueCreating;
use App\Exceptions\Catalog\Product\AttributeValueCreationFailed;

class PreventDuplicateAttributeValue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AttributeValueCreating  $event
     * @return void
     */
    public function handle(AttributeValueCreating $event)
    {
        $existingValue = AttributeValue::where([
            'product_id' => $event->attributeValue->product_id,
            'attribute_id' => $event->attributeValue->attribute_id,
            'company_id' => $event->attributeValue->company_id,
        ])->first();

        if ($existingValue) {
            throw new AttributeValueCreationFailed("A value already exists for this combination of Product, Attribute, and Company");
        }
    }
}
