<?php

namespace App\Models\ApiModels;

use App\Models\Folder;
use App\Models\Site;
use App\Models\SiteImage;
use Carbon\Carbon;

class SiteImageApiModel
{
    /** @var integer */
    public $id;

    /** @var Carbon */
    public $createdAt;

    /** @var Carbon */
    public $updatedAt;

    /** @var string */
    public $originalFileName;

    /** @var string */
    public $s3Path;

    /**
     * @param SiteImage $entity
     * @return SiteImageApiModel
     */
    static function fromEntity(SiteImage $entity): SiteImageApiModel
    {
        $apiModel = new SiteImageApiModel();

        $apiModel->id = $entity->id;
        $apiModel->createdAt = $entity->created_at;
        $apiModel->updatedAt = $entity->updated_at;
        $apiModel->originalFileName = $entity->original_file_name;
        $apiModel->s3Path = $entity->s3_path;

        return $apiModel;
    }

    /**
     * @param SiteImage[] $entities
     * @return SiteImageApiModel[]
     */
    static function fromEntities($entities): array
    {
        $siteImages = [];

        foreach ($entities as $entity) {
            $siteImages[] = self::fromEntity($entity);
        }

        return $siteImages;
    }
}
