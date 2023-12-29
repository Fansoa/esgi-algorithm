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

    // Add a book
    public function addBook(string $title, string $description, bool $available) : void
    {
        $newBook = new Book($title, $description, $available);
        array_push($this->bookList, $newBook);
    }

    //  Get the book list
    public function getBookList()
    {
        return $this->bookList;
    }

    //  Display the book list give in parameter of the function
    public function displayList($bookList)
    {
        foreach ($bookList as $book) {
            echo($book->getDetails()."\n");
        }
    }

    // Display the list book of all
    public function displayAll()
    {
        $this->displayList($this->bookList);
    }

    //  Allows you to retrieve a book based on the value of one of these attributes
    public function getBookBy($column, $value)
    {
        $functionName = 'get'.ucfirst($column);
        for ($i=0; $i < count($this->bookList) ; ++$i) {
            if ($this->bookList[$i]->$functionName() === $value) {
                return $this->bookList[$i]->getDetails();
            }
        }
    }

    // Sort the book list by attribute and order (ascending/descending) using the merge sort method
    public function sortBookByAttributeAndOrderType($attribute, $orderType)
    {
        //  merge function
        
        //  $leftArray: First array of objects to merge.
        //  $rightArray: Second array of objects to merge.
        //  $orderType: Type of sorting ('ascending' for ascending order, anything else for descending order).
        //  $attribute: Attribute used to compare the objects.

        function merge($leftArray, $rightArray, $orderType, $attribute)
        {
            $leftArraySize = count($leftArray);
            $rightArraySize = count($rightArray);
            $sortedArray = array();
            $i_left = 0; $i_right = 0;

            //  Retrieve the attribute and add the 'get' prefix to it in order to be able to retrieve the value of a given attribute of the object
            $getterFunctionName = 'get'.$attribute;

            for ($i = 0; $i_left < $leftArraySize && $i_right < $rightArraySize; ++$i)
            {
                //  If the value to compare is a string
                if (is_string($leftArray[$i_left]->$getterFunctionName()))
                {
                    if ($orderType == 'ascending')
                    {
                        if (strcasecmp($leftArray[$i_left]->$getterFunctionName(), $rightArray[$i_right]->$getterFunctionName()) < 0)
                        {
                            $sortedArray[$i] = $leftArray[$i_left++];
                        }
                        else
                        {
                            $sortedArray[$i] = $rightArray[$i_right++];
                        }
                    }
                    else 
                    {

                        var_dump($attribute);
                        if (strcasecmp($leftArray[$i_left]->$getterFunctionName(), $rightArray[$i_right]->$getterFunctionName()) > 0)
                        {
                            $sortedArray[$i] = $leftArray[$i_left++];
                        }
                        else
                        {
                            $sortedArray[$i] = $rightArray[$i_right++];
                        }
                    }
                } 
                //  If the value to compare is an integer
                elseif (is_integer($leftArray[$i_left]->$getterFunctionName()))
                {
                    if ($orderType == 'ascending')
                    {
                        if ($leftArray[$i_left]->$getterFunctionName() <= $rightArray[$i_right]->$getterFunctionName())
                        {
                            $sortedArray[$i] = $leftArray[$i_left++];
                        }
                        else
                        {
                            $sortedArray[$i] = $rightArray[$i_right++];
                        }
                    }
                    else 
                    {
                        if ($leftArray[$i_left]->$getterFunctionName() >= $rightArray[$i_right]->$getterFunctionName())
                        {
                            $sortedArray[$i] = $leftArray[$i_left++];
                        }
                        else
                        {
                            $sortedArray[$i] = $rightArray[$i_right++];
                        }
                    }
                }
                //  If the value to compare is a boolean
                else
                {
                    if ($orderType == 'ascending')
                    {
                        if ($leftArray[$i_left]->$getterFunctionName())
                        {
                            $sortedArray[$i] = $leftArray[$i_left++];
                        }
                        else
                        {
                            $sortedArray[$i] = $rightArray[$i_right++];
                        }
                    }
                    else 
                    {
                        if (!$leftArray[$i_left]->$getterFunctionName())
                        {
                            $sortedArray[$i] = $leftArray[$i_left++];
                        }
                        else
                        {
                            $sortedArray[$i] = $rightArray[$i_right++];
                        }
                    }
                }
                
                
                
            }
            //  Copy the rest of the array on the left (if there is anything left) */
            while ($i_left < $leftArraySize)
            $sortedArray[$i++] = $leftArray[$i_left++];
            //  Same for the right array */
            while ($i_right < $rightArraySize)
            $sortedArray[$i++] = $rightArray[$i_right++];

            //  Once the merge and sorting are done, the function returns the $sortedArray, which contains the merged and sorted objects.
            return $sortedArray;
        }

        //  arrayCopy function

        //  Copy a part of an Array
        
        //  $array: The original array from which a portion will be copied.
        //  $beginning: The starting index from which the copy begins.
        //  $end: The ending index where the copy stops.

        function arrayCopy($array, $beginning, $end)
        {
            $copiedArray = array();

            //  The for loop iterates through the original array from the $beginning index to the $end index (inclusive). 
            //  It copies each element of the original array into the $copiedArray using the adjusted index $i - $beginning. 
            //  This adjustment allows the copied array to start from index 0.
            for ($i = $beginning; $i <= $end; ++$i)
                $copiedArray[$i - $beginning] = $array[$i];
            return $copiedArray;
        }

        //  sortByMerge function

        //  Implements a sorting algorithm known as merge sort. Here's a breakdown of its functionality

        //  $array: The array to be sorted.
        //  $orderType: The type of sorting ('ascending' for ascending order, anything else for descending order).
        //  $attribute: The attribute based on which the sorting will be performed.
        function sortByMerge($array, $orderType, $attribute)
        {
            $size = count($array);

            // If the size of the array is greater than 1, it proceeds with the merge sort algorithm:
            //  It calculates the center of the array.
            //  Splits the array into two parts, leftPart and rightPart, using the arrayCopy function (presumably copying the left and right halves of the array).
            //  Recursively calls sortByMerge on the left and right parts to sort them.
            //  Merges the sorted left and right parts using the merge function to combine them into a single sorted array.
            //  Recursion: This function uses a divide-and-conquer strategy, breaking the array into smaller parts until it reaches individual elements,
            //  then merges and sorts them back together.
            if ($size <= 1)
            {
                return $array;
            }
            else 
            {
                $center = (int)($size / 2);
                $leftPart = arrayCopy($array, 0, $center-1);
                $rightPart = arrayCopy($array, $center, $size-1);
                return merge(sortByMerge($leftPart, $orderType, $attribute), sortByMerge($rightPart, $orderType, $attribute), $orderType, $attribute);
            }
        }

        return sortByMerge($this->bookList, $orderType, $attribute);
    }
}

$bookManager = new BookManagement();

echo('<pre>');

$bookManager->addBook('abc', 'description1', false);
$bookManager->addBook('bcd', 'description2', true);
$bookManager->addBook('d', 'description2', false);
$bookManager->addBook('z', 'description2', true);
$bookManager->addBook('d', 'description2', false);
$bookManager->addBook('gf', 'description2', true);
$bookManager->addBook('xcv', 'description2', false);


$bookManager->getBookBy('title', 'titre1');

var_dump($bookManager->sortBookByAttributeAndOrderType('Available', 'descending'));