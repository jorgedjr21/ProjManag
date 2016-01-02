<?php
/**
 * Created by PhpStorm.
 * User: jorge
 * Date: 02/01/16
 * Time: 10:00
 */

namespace ProjManag\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use ProjManag\Transformers\ProjectNotesTransformer;
use ProjManag\Transformers\ProjectTasksTransformer;


class ProjectTasksPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new ProjectTasksTransformer();
    }

}