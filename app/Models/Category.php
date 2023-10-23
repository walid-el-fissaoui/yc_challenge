<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const ID_COLUMN = "id";
    public const NAME_COLUMN = "name";
    public const PARENT_COLUMN = "parent";

    protected $fillable = [
        self::NAME_COLUMN,
        self::PARENT_COLUMN
    ];

    public function getId()
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName()
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getParent()
    {
        return $this->getAttribute(self::PARENT_COLUMN);
    }
}
