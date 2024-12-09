<?php
namespace Model;

class Feedback
{
    public $id;         // ID du feedback
    public $rating;     // Évaluation (note)
    public $comment;    // Commentaire

    public function __construct($id, $rating, $comment)
    {
        $this->id = $id;
        $this->rating = $rating;
        $this->comment = $comment;
    }
}
