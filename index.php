<?php

class Book
{
    protected $title;
    protected $description;
    protected $available;

    public function __construct(string $title, string $description, bool $available)
    {
        $this->id = uniqid();
        $this->title = $title;
        $this->description = $description;
        $this->available = $available;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setAvailable(bool $available)
    {
        $this->available = $available;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function getAvailable() : bool
    {
        return $this->available;
    }

    public function getDetails() : string
    {
        return "$this->title $this->description $this->available";
    }
}

// $title = "Harry Potter a l'école des sorciers";
// $description = "Harry Potter, un jeune orphelin, est élevé par son oncle et sa tante qui le détestent. Alors qu'il était haut comme trois pommes, ces derniers lui ont raconté que ses parents étaient morts dans un accident de voiture. Le jour de son onzième anniversaire, Harry reçoit la visite inattendue d'un homme gigantesque se nommant Rubeus Hagrid, et celui-ci lui révèle qu'il est en fait le fils de deux puissants magiciens et qu'il possède lui aussi d'extraordinaires pouvoirs.";

// $array = [];

// $newBook1 = new Book('titre1', 'description1', true);
// $newBook2 = new Book('titre2', 'description2', true);

// echo('<pre>');
// var_dump($newBook1->getDetails());

// array_push($array, $newBook1);
// array_push($array, $newBook2);

// var_dump($array);

class BookManagement {
    protected $bookList = [];

    public function addBook(string $title, string $description, bool $available) : void
    {
        $newBook = new Book($title, $description, $available);
        array_push($this->bookList, $newBook);
    }

    public function getBookList()
    {
        return $this->bookList;
    }

    public function displayList($bookList)
    {
        foreach ($bookList as $book) {
            echo($book->getDetails()."\n");
        }
    }

    public function displayAll()
    {
        $this->displayList($this->bookList);
    }

    public function getBookBy($column, $value)
    {
        $functionName = 'get'.ucfirst($column);
        for ($i=0; $i < count($this->bookList) ; ++$i) {
            if ($this->bookList[$i]->$functionName() === $value) {
                return $this->bookList[$i]->getDetails();
            }
        }
    }


}

$bookManager = new BookManagement();

echo('<pre>');

$bookManager->addBook('titre1', 'description1', true);
$bookManager->addBook('titre2', 'description2', true);

var_dump($bookManager->displayAll());

$bookManager->getBookBy('title', 'titre1');