<?php

namespace App\Controllers;

use App\Manager\CommentManager;
use App\Models\Comment;

class CommentsController extends AppController {

  // public function index() {

  // }

  // public function show($id) {

  // }

  public function new() {
    $this->render('comments/new');
  }

  public function create() {
    
  }

  public function edit($id) {
    $this->render('comments/edit');
  }

  public function update($id) {

  }

  public function destroy($id) {

  }
}