<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
  use ApiResponser;

  public function index()
  {
    $authors = Author::all();

    return $this->successResponse($authors);
  }

  public function store(Request $req)
  {
    $rules = [
      'name' => 'required|max:255',
      'gender' => 'required|max:10|in:male,female',
      'country' => 'required|max:255',
    ];

    $this->validate($req, $rules);

    $authors = Author::create($req->all());

    return $this->successResponse($authors, Response::HTTP_CREATED);
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
