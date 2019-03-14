<?php

namespace Jmp\ProductSpecSheetManager\Http\Controllers;

use App\Company;
use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;

class SpecSheetController extends Controller
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
    public function getData()
    {
        $companies = Company::all();

        return response()->json([
            'companies' => $companies,
        ]);
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
    public function fetch(NovaRequest $request)
    {
        $novaResource = $request->findResourceOrFail($request->resourceId);
        // $novaResource = new SpecSheet($model);

        return $novaResource->serializeForDetail($request);
    }
}
