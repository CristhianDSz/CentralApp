<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LearningSection extends Model
{
    protected $table = 'learning_sections';
    protected $fillable = ['title', 'start_date', 'end_date', 'context', 'ova_id'];
    protected $hidden = ['created_at','updated_at'];

    public function ova()
    {
        return $this->belongsTo(Ova::class);
    }

    public function components()
    {
        return $this->belongsToMany(Component::class)->withTimestamps();
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class)->withTimestamps();
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class)->withTimestamps();
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function bibliographies()
    {
        return $this->hasMany(Bibliography::class);
    }

    public function homeworks()
    {
        return $this->hasMany(Homework::class);
    }

   
    /** CUSTOM MODEL METHODS */
    
    /**
     * Add many resources (Resource class) to one learning section (LearningSection class)
     *
     * @param array $resources
     * @return void
     */
    public function addManyResources($resources = [])
    {
        if (count($resources) > 0) {
            foreach ($resources as $resource) {
                $this->addResource($resource);
            }
        }
    }

    /**
     * Add one resource to one learning section through its relationship
     *
     * @param array $resource
     * @return void
    */
    public function addResource($resource =[])
    {
        return $this->resources()->create($resource);
    }

    /**
     * Add many bibliographies (Bibliography class) to one learning section (LearningSection class)
     *
     * @param array $bibliographies
     * @return void
    */
    public function addManyBibliographies($bibliographies = [])
    {
        if (count($bibliographies) > 0) {
            foreach ($bibliographies as $bibliography) {
                $this->addBibliography($bibliography);
            }
        }
    }
    
    /**
     * Add one bibliography to one learning section through its relationship
     *
     * @param array $bibliography
     * @return void
     */
    public function addBibliography($bibliography = [])
    {
        return $this->bibliographies()->create($bibliography);
    }

    /**
     * Update many resources (Resource class) to one learning section (LearningSection class)
     *
     * @param array $resources
     * @return void
     */
    public function updateManyResources($resources = [])
    {
        if (count($resources) > 0) {
            foreach ($resources as $resource) {
                $this->updateResource($resource);
            }
        }
    }

    /**
     * Update one resource to one learning section through its relationship
     *
     * @param array $resource
     * @return void
    */
    public function updateResource($resource = [])
    {
        return $this->resources()
        ->where('id',$resource['id'])
        ->update($resource);   
    }

    /**
     * Update many bibliographies (Bibliography class) to one learning section (LearningSection class)
     *
     * @param array $bibliographies
     * @return void
    */
    public function updateManyBibliographies($bibliographies = [])
    {
        if (count($bibliographies) > 0) {
            foreach ($bibliographies as $bibliography) {
                $this->updateBibliography($bibliography);
            }
        }
    }

    /**
     * Update one bibliography to one learning section through its relationship
     *
     * @param array $bibliography
     * @return void
    */
    public function updateBibliography($bibliography = [])
    {
        return $this->bibliographies()
        ->where('id',$bibliography['id'])
        ->update($bibliography);
    }

    /**
     * Add many homeworks (Homework class) to one learning section (LearningSection class)
     *
     * @param array $homeworks
     * @return void
     */
    public function addManyHomeworks($homeworks = [])
    {
        if (count($homeworks) > 0) {
            foreach ($homeworks as $homework) {
                $this->addHomework($homework);
            }
        }
    }

    /**
     * Add one homework to one learning section through its relationship
     *
     * @param array $homework
     * @return void
    */
    public function addHomework($homework =[])
    {
        return $this->homeworks()->create($homework);
    }
    
    /**
     * Add many homeworks (Homework class) to one learning section (LearningSection class)
     *
     * @param array $homeworks
     * @return void
     */
    public function updateManyHomeworks($homeworks = [])
    {
        if (count($homeworks) > 0) {
            foreach ($homeworks as $homework) {
                $this->updateHomework($homework);
            }
        }
    }

    /**
     * Add one homework to one learning section through its relationship
     *
     * @param array $homework
     * @return void
    */
    public function updateHomework($homework =[])
    {
        if (array_key_exists('presentation',$homework)) {
            unset($homework['presentation']);
        }
        return $this->homeworks()
        ->where('id',$homework['id'])
        ->update($homework);
    }



}
