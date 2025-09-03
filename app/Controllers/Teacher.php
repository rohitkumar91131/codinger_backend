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
        return $this->respond([
            'success' => true,
            'teachers' => $teachers
        ]);
    }

    public function show($id = null)
    {
        if (!$id) {
            return $this->respond([
                'success' => false,
                'error' => 'Teacher ID is required'
            ], 400);
        }

        $teacher = $this->model->find($id);
        if (!$teacher) {
            return $this->respond([
                'success' => false,
                'error' => 'Teacher not found'
            ], 404);
        }

        return $this->respond([
            'success' => true,
            'teacher' => $teacher
        ]);
    }

    public function update($id = null)
    {
        if (!$id) {
            return $this->respond([
                'success' => false,
                'error' => 'Teacher ID is required'
            ], 400);
        }

        $teacher = $this->model->find($id);
        if (!$teacher) {
            return $this->respond([
                'success' => false,
                'error' => 'Teacher not found'
            ], 404);
        }

        $data = $this->request->getJSON();
        $updateData = [
            'user_id' => $data->user_id ?? $teacher['user_id'],
            'name' => $data->name ?? $teacher['name'],
            'subject' => $data->subject ?? $teacher['subject'],
            'university_name' => $data->university_name ?? $teacher['university_name'],
            'gender' => $data->gender ?? $teacher['gender'],
            'year_joined' => $data->year_joined ?? $teacher['year_joined']
        ];

        $this->model->update($id, $updateData);

        return $this->respond([
            'success' => true,
            'teacher' => $this->model->find($id)
        ]);
    }
}
