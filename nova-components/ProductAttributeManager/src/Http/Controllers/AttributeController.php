<?php

namespace Jmp\ProductAttributeManager\Http\Controllers;

use App\Catalog\Product\Attribute;
use App\Catalog\Product\AttributeValue;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AttributeController extends Controller
{
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param   type var Description
     * @return  return type
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function getData($productId)
    {
        $companies = Company::all();
        $values = AttributeValue::where('product_id', $productId)->get();
        $attributeIds = $values->map(function ($value, $key) {
            return $value->attribute->id;
        });

        $attributes = Attribute::find($attributeIds);

        return response()->json([
            'companies' => $companies,
            'attributes' => $attributes,
            'attributeValues' => $values,
        ]);
    }

    /**
     * Create an attribute, and value for a product
     *
     * @param   int $productId Product id
     * @param   Illuminate\Http\Request $request
     * @return  \Illuminate\Http\Response
     */
    public function createAttribute(Request $request, $productId)
    {
        $name = $request->input('name');
        $value = $request->input('value');
        $companyId = $request->input('company_id');

        $attribute = Attribute::firstOrCreate(['name' => $name]);
        $existingValue = AttributeValue::where([
            'product_id' => $productId,
            'attribute_id' => $attribute->id,
            'company_id' => $companyId,
        ])->first();

        if ($existingValue) {
            abort(400, 'There is already an attribute with this name');
        }

        $value = AttributeValue::firstOrCreate([
            'product_id' => $productId,
            'attribute_id' => $attribute->id,
            'value' => $value,
            'company_id' => $companyId,
        ]);

        return response()->json($value);
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param   type var Description
     * @return  return type
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function updateAttribute(Request $request)
    {
        $attributeData = $request->input('attribute');
        $attributeValueData = $request->input('attributeValue');

        $attribute = Attribute::find($attributeData['id']);
        $attribute->name = $attributeData['name'];
        $attribute->save();

        if (array_key_exists('id', $attributeValueData)) {
            $attributeValue = AttributeValue::find($attributeValueData['id']);
        } else {
            $attributeValue = new AttributeValue;
        }

        $attributeValue->fill($attributeValueData);

        $attributeValue->save();
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param   type var Description
     * @return  return type
     * @author  Nevin Morgan <nevins.morgan@gmail.com
     */
    public function deleteAttributeValue($id)
    {
        AttributeValue::destroy($id);
    }
}
