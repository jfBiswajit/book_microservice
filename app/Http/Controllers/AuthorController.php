<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;

class AuthorController extends Controller
{
  use ApiResponser;

  public function index()
  {
    $authors = Author::all();

    return $this->successResponse($authors);
  }

  public function store()
  {
  }

  public function show()
  {
  }

  public function update()
  {
  }

  public function destroy()
  {
  }
}
