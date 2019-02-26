<?php

namespace Jmp\CompanyCatalogManager\Http\Controllers;

use App\Catalog\Category;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    /**
     * Get the categories for a company
     *
     * @param   int $id Company id
     * @return  \Illuminate\Http\Response
     */
    public function getCategories($id)
    {
        $company = Company::find($id);
        $categories = $company->categories;
        $category = $categories->first();

        if ($category) {
            return response()->json($category->get()->toTree());
        }

        return response()->json([]);
    }

    /**
     * update the categories for a company
     *
     * @param   int $id Company id
     */
    public function updateCategories(Request $request, $id)
    {
        Category::rebuildTree($request->all());
        return response()->json([]);
    }

    /**
     * delete a category by id
     *
     * @param   int $id Company id
     */
    public function deleteCategory($id)
    {
        Category::destroy($id);
    }
}
