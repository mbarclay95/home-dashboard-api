<?php

namespace App\Models\ApiModels;

use App\Models\Folder;
use App\Models\Site;
use App\Models\SiteImage;
use Carbon\Carbon;

class SiteApiModel
{
    /** @var integer */
    public $id;

    /** @var Carbon */
    public $createdAt;

    /** @var Carbon */
    public $updatedAt;

    /** @var string */
    public $name;

    /** @var string */
    public $description;

    /** @var integer */
    public $sort;

    /** @var boolean */
    public $show;

    /** @var string */
    public $url;

    /** @var integer */
    public $folderId;

    /** @var SiteImage */
    public $siteImage;

    /**
     * @param Site $entity
     * @return SiteApiModel
     */
    static function fromEntity(Site $entity): SiteApiModel
    {
        $apiModel = new SiteApiModel();

        $apiModel->id = $entity->id;
        $apiModel->createdAt = $entity->created_at;
        $apiModel->updatedAt = $entity->updated_at;
        $apiModel->name = $entity->name;
        $apiModel->description = $entity->description;
        $apiModel->sort = $entity->sort;
        $apiModel->show = $entity->show;
        $apiModel->url = $entity->url;
        $apiModel->siteImage = $entity->siteImage ? SiteImageApiModel::fromEntity($entity->siteImage) : null;
        $apiModel->folderId = $entity->folder_id;

        return $apiModel;
    }

    /**
     * @param Site[] $entities
     * @return SiteApiModel[]
     */
    static function fromEntities($entities): array
    {
        $sites = [];

        foreach ($entities as $entity) {
            $sites[] = self::fromEntity($entity);
        }

        return $sites;
    }
}
