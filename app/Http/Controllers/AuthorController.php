<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponser;
use GrahamCampbell\ResultType\Result;
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

  public function show($id)
  {
    $author = Author::findOrFail($id);
    return $this->successResponse($author);
  }

  public function update(request $req, $id)
  {
    $rules = [
      'name' => 'max:255',
      'gender' => 'max:10|in:male,female',
      'country' => 'max:255',
    ];

    $this->validate($req, $rules);
    $author = Author::findOrFail($id);
    $author->fill($req->all());

    if ($author->isClean()) {
      return $this->errorResponse('Nothing is to update!', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $author->save();
    return $this->successResponse($author);
  }

  public function destroy($id)
  {
    $author = Author::findOrFail($id);
    $author->delete();

    return $this->successResponse($author);
  }
}
