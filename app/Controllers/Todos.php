<?php
namespace App\Controllers;
use App\Models\TodoModel;
use CodeIgniter\Controller;
class Todos extends Controller{
    public function index(){
        $todoModel = new TodoModel();
        $userId = session()->get('user_id');
        $data['todos'] = $todoModel->where('user_id', $userId)->findAll();
        return view('todos/index', $data);
    }

    public function create(){
        return view('todos/create');
    }

    public function store(){
        $todoModel = new TodoModel();
        $data = [
            'user_id' => session()->get('user_id'),
            'task' => $this->request->getPost('task'),
            'status' => 'pending'
        ];
        $todoModel->insert($data);
        return redirect()->to('/todos');
    }

    public function delete($id){
        $todoModel = new TodoModel();
        // Ensure the user can only delete their own todos
        $todo = $todoModel->where('id', $id)->where('user_id', session()->get('user_id'))->first();
        if ($todo) {
            $todoModel->delete($id); // Delete the todo
        }
        return redirect()->to('/todos'); // Redirect back to the todos list
    }


    public function update($id){
        $todoModel = new TodoModel();
        $status = $this->request->getPost('status');
        $todoModel->update($id, ['status' => $status]);
        return redirect()->to('/todos');
    }
}
