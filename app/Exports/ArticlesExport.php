<?php

namespace App\Exports;

use App\Article;
use App\Http\Service\ArticleService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArticlesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($article)
    {
        $this->article = $article;
    }
    public function collection()
    {
        return $this->article;
    }
    public function headings(): array
    {
        return ["id","title", "content", "created_at"];
    }
}
