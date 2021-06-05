<?php

namespace App\Models\ApiModels;

use App\Models\Folder;
use Carbon\Carbon;

class FolderApiModel
{
    /** @var integer */
    public $id;

    /** @var Carbon */
    public $createdAt;

    /** @var Carbon */
    public $updatedAt;

    /** @var string */
    public $name;

    /** @var integer */
    public $sort;

    /** @var boolean */
    public $show;

    /** @var array */
    public $sites;

    /**
     * @param Folder $entity
     * @param bool $withSites
     * @return FolderApiModel
     */
    static function fromEntity(Folder $entity, bool $withSites = true): FolderApiModel
    {
        $apiModel = new FolderApiModel();

        $apiModel->id = $entity->id;
        $apiModel->createdAt = $entity->created_at;
        $apiModel->updatedAt = $entity->updated_at;
        $apiModel->name = $entity->name;
        $apiModel->sort = $entity->sort;
        $apiModel->show = $entity->show;
        $apiModel->sites = $withSites ? SiteApiModel::fromEntities($entity->sites) : [];

        return $apiModel;
    }

    /**
     * @param Folder[] $entities
     * @return FolderApiModel[]
     */
    static function fromEntities($entities): array
    {
        $folders = [];

        foreach ($entities as $entity) {
            $folders[] = self::fromEntity($entity);
        }

        return $folders;
    }
}
