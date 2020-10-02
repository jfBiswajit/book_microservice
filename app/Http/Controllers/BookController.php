<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Traits\ApiResponser;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
  use ApiResponser;

  public function index()
  {
    $books = Book::all();

    return $this->successResponse($books);
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
    $book = Book::findOrFail($id);
    return $this->successResponse($book);
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
    $book = Book::findOrFail($id);
    $book->delete();

    return $this->successResponse($book);
  }
}
