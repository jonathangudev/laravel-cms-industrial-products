<?php

namespace App\MediaLibrary;

use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\Models\Media;

class PathGenerator implements \Spatie\MediaLibrary\PathGenerator\PathGenerator
{
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media) . '/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media) . '/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media) . '/responsive-images/';
    }

    /*
     * Get a unique base path for the given media.
     */
    protected function getBasePath(Media $media): string
    {
        $model = $media->model;
        $restrictedAssetModels = Config::get('medialibrary.restricted_asset_models');
        $isRestrictedAssetModel = in_array(get_class($model), $restrictedAssetModels);

        if ($isRestrictedAssetModel && $company = $model->company) {
            return $company->uuid . '/' . $media->collection_name . '/' . $media->getKey();
        }

        return $media->getKey();
    }
}
