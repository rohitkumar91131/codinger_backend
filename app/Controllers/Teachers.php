<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\TeacherModel;

class Teacher extends ResourceController
{
    protected $modelName = 'App\Models\TeacherModel';
    protected $format = 'json';

    public function index()
    {
        $teachers = $this->model->findAll();
        return $this->respond($teachers);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON();

        if(!$id) {
            return $this->fail("Teacher ID is required");
        }

        $teacher = $this->model->find($id);
        if(!$teacher) {
            return $this->failNotFound("Teacher not found");
        }

        $updateData = [
            'user_id' => $data->user_id ?? $teacher['user_id'],
            'name' => $data->name ?? $teacher['name'],
            'subject' => $data->subject ?? $teacher['subject'],
        ];

        $this->model->update($id, $updateData);
        return $this->respondUpdated($this->model->find($id));
    }


    public function show($id = null)
    {
        $teacher = $this->model->find($id);
        if(!$teacher) {
            return $this->failNotFound("Teacher not found");
        }
        return $this->respond($teacher);
    }
}
