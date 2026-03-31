<?php
class Home extends Controller {
    public function index() {
        $this->view('home/index', ['title' => 'Vítejte doma!']);
    }
}

$this->view('home/index', ['users' => $users]);
?>