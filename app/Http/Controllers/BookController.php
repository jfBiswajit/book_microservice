<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Traits\ApiResponser;
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
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
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'price' => 'required|min:1',
      'author_id' => 'required|min:1',
    ];

    $this->validate($req, $rules);

    $book = Book::create($req->all());

    return $this->successResponse($book, Response::HTTP_CREATED);
  }

  public function show($id)
  {
    $book = Book::findOrFail($id);
    return $this->successResponse($book);
  }

  public function update(request $req, $id)
  {
    $rules = [
      'title' => 'max:255',
      'description' => 'max:255',
      'price' => 'min:1',
      'author_id' => 'min:1',
    ];

    $this->validate($req, $rules);
    $book = Book::findOrFail($id);
    $book->fill($req->all());

    if ($book->isClean()) {
      return $this->errorResponse('Nothing is to update!', Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    $book->save();
    return $this->successResponse($book);
  }

  public function destroy($id)
  {
    $book = Book::findOrFail($id);
    $book->delete();

    return $this->successResponse($book);
  }
}
