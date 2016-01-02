<?php

namespace ProjManag\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ProjManag\Presenters\ProjectNotePresenter;
use ProjManag\Presenters\ProjectNotesPresenter;
use ProjManag\Repositories\ProjectNoteRepository;
use ProjManag\Entities\ProjectNote;

/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace ProjManag\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter(){
        return ProjectNotesPresenter::class;
    }
}
