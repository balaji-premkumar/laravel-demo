<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  @OA\Property(property="title",type="string",description="Post Title"),
 *  @OA\Property(property="description",type="string",description="Post Title"),
 *  @OA\Property(property="status",type="boolean",description="Post Status"),
 *  @OA\Property(property="deleted",type="string",description="Post Deleted Status"),
 *  @OA\Property(property="created_at", type="string", format="date-time", description="Initial creation timestamp", readOnly="true"),
 *  @OA\Property(property="updated_at", type="string", format="date-time", description="Last update timestamp", readOnly="true"),
 * )
 *
 * Class Posts
 * @package App\Models
 */
class Posts extends Model
{
    protected $table = "posts";
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'deleted'];
    protected $hidden = ['deleted', 'status'];
}
