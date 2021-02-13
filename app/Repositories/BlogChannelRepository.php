<?php


namespace App\Repositories;


use App\Models\BlogChannel as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogChannelRepository extends CoreRepository
{
    protected function getModelClass()
    {
        // TODO: Implement getModelClass() method.
        return Model::class;
    }
    /**
     *  Get a list of categories to display in the list
     * @return Collection
     */
    public function getChannelList()
    {

    }

    public function getAllWithPaginate($perPage = null)
    {

    }

}
